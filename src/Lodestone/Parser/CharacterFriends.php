<?php

namespace Lodestone\Parser;

use Lodestone\Modules\Logger,
    Lodestone\Modules\XIVDB;

/**
 * Class CharacterFriends
 * @package src\Parser
 */
class CharacterFriends extends ParserHelper
{
    /**
     * @param bool|string $html
     * @return array|bool
     */
    public function parse($html = false)
    {
        if (!$html) {
            $html = $this->html;
        }

        // check exists
        if ($this->is404($html)) {
            return false;
        }

        $html = $this->trim($html, 'class="ldst__main"', 'class="ldst__side"');
        if (!$html) {
            return false;
        }

        $this->setInitialDocument($html);

        // no friends
        if ($this->getDocument()->find('.parts__zero', 0)) {
            return false;
        }

		$started = microtime(true);
		$this->pageCount();
		$this->parseList();
        Logger::write(__CLASS__, __LINE__, sprintf('PARSE DURATION: %s ms', round(microtime(true) - $started, 3)));

		return $this->data;
	}

    /**
     * Parse page count
     */
	private function pageCount()
	{
		// page count
		$data = $this->getDocument()->find('.btn__pager__current', 0)->plaintext;
		list($current, $total) = explode(' of ', $data);

        $current = filter_var($current, FILTER_SANITIZE_NUMBER_INT);
        $total = filter_var($total, FILTER_SANITIZE_NUMBER_INT);

		$this->add('page_total', $total);
		$this->add('page_current', $current);

		// member count
        $data = $this->getDocument()->find('.parts__total', 0)->plaintext;
        $data = filter_var($data, FILTER_SANITIZE_NUMBER_INT);
        $this->add('character_total', $data);
	}

    /**
     * Parse members
     */
	private function parseList()
	{
		$rows = $this->getDocumentFromClassname('.ldst__window');

		$characters = [];
		foreach($rows->find('div.entry') as $node) {
			$characters[] = [
			    'id' => explode('/', $node->find('a', 0)->getAttribute('href'))[3],
			    'name' => trim($node->find('.entry__name')->plaintext),
                'server' => trim($node->find('.entry__world')->plaintext),
                'avatar' => explode('?', $node->find('.entry__chara__face img', 0)->src)[0],
            ];
		}

		$this->add('members', $characters);
	}
}
