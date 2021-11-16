<?php

namespace App\Service;

use Symfony\Contracts\Translation\TranslatorInterface;

class LayoutService
{

    private TranslatorInterface $translator;

    /**
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }


    /**
     * @return string
     */
    public function title()
    {
        return $this->translator->trans('project_name');
    }

    public function nav()
    {

    }

    public function footer()
    {

    }

}
