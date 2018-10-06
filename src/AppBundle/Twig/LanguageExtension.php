<?php

namespace AppBundle\Twig;

use AppBundle\Languages;

class LanguageExtension extends \Twig_Extension {

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('language', array($this, 'languageFilter')),
        );
    }

    public function languageFilter($language) {
        return Languages::fromKey($language);
    }

}