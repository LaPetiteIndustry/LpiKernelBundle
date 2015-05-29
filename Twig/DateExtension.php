<?php
namespace Lpi\KernelBundle\Twig;

use Lpi\KernelBundle\Utils\Utils;
use Sonata\IntlBundle\Twig\Extension\DateTimeExtension;

class DateExtension extends DateTimeExtension
{

    public function getFunctions()
    {
        return array(
            'frenchDate' => new \Twig_Function_Method($this, 'eventDate'),
            'frenchTime' => new \Twig_Function_Method($this, 'eventTime'),
            'slugify' => new \Twig_Function_Method($this, 'slugify'),
            'displayMonthName' => new \Twig_Function_Method($this, 'displayMonthName')
        );
    }

    public function eventDate($date)
    {
        return $this->formatDate($date, 'dd/MM/YY', 'fr');

    }

    public function eventTime($date)
    {
        return str_replace('%', 'h', $this->formatTime($date, 'HH%mm', 'fr'));
    }

    public function displayMonthName($monthNumber)
    {
            $months =
                [
                    '01'=>'Janvier',
                    '02'=>'Février',
                    '03'=>'Mars',
                    '04'=>'Avril',
                    '05'=>'Mai',
                    '06'=>'Juin',
                    '07'=>'Juillet',
                    '08'=>'Août',
                    '09'=>'Septembre',
                    '10'=>'Octobre',
                    '11'=>'Novembre',
                    '12'=>'Décembre',
                ];

        return $months[$monthNumber];
    }

    public function slugify($string)
    {
        return Utils::slugify($string);
    }

    public function getName()
    {
        return 'date_extensions';
    }
}