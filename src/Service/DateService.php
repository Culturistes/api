<?php

namespace App\Service;

class DateService
{
    public function get_nb_open_days($date_start, $date_stop) {	
        $arr_bank_holidays = array(); // Tableau des jours feriés	
        
        // On boucle dans le cas où l'année de départ serait différente de l'année d'arrivée
        $diff_year = date('Y', $date_stop) - date('Y', $date_start);
        for ($i = 0; $i <= $diff_year; $i++) {			
            $year = (int)date('Y', $date_start) + $i;
            // Liste des jours feriés
            $arr_bank_holidays[] = '1_1_'.$year; // Jour de l'an
            $arr_bank_holidays[] = '1_5_'.$year; // Fete du travail
            $arr_bank_holidays[] = '8_5_'.$year; // Victoire 1945
            $arr_bank_holidays[] = '14_7_'.$year; // Fete nationale
            $arr_bank_holidays[] = '15_8_'.$year; // Assomption
            $arr_bank_holidays[] = '1_11_'.$year; // Toussaint
            $arr_bank_holidays[] = '11_11_'.$year; // Armistice 1918
            $arr_bank_holidays[] = '25_12_'.$year; // Noel
                    
            // Récupération de paques. Permet ensuite d'obtenir le jour de l'ascension et celui de la pentecote	
            // $easter = easter_date($year);
            $arr_bank_holidays[] = date('5_4_'.$year); // Paques
            $arr_bank_holidays[] = date('13_5_'.$year); // Ascension
            $arr_bank_holidays[] = date('23_5_'.$year); // Pentecote	
        }
        //print_r($arr_bank_holidays);
        $nb_days_open = 0;
        // Mettre <= si on souhaite prendre en compte le dernier jour dans le décompte	
        while ($date_start < $date_stop) {
            // Si le jour suivant n'est ni un dimanche (0) ou un samedi (6), ni un jour férié, on incrémente les jours ouvrés	
            if (!in_array(date('w', $date_start), array(0, 6)) 
            && !in_array(date('j_n_'.date('Y', $date_start), $date_start), $arr_bank_holidays)) {
                $nb_days_open++;		
            }
            $date_start = mktime(date('H', $date_start), date('i', $date_start), date('s', $date_start), date('m', $date_start), date('d', $date_start) + 1, date('Y', $date_start));			
        }		
        return $nb_days_open;
    }

    public function getDates() {
        $date_oral_intermediaire = strtotime('2021-05-05');
        $date_dossier_intention = strtotime('2021-05-28');
        $date_dossier_technique = strtotime('2021-06-11');
        $date_oral = strtotime('2021-06-23');

        $today = strtotime(date("y-m-d"));
        $start_school = strtotime('2021-05-03');
        if($today < $start_school) {
            $today = $start_school;
        }

        $dates = array(
            'oral_intermediaire' => array('name' => 'Oral intermédiaire', 'date' => '5 mai', 'day_left' => $this->get_nb_open_days($today, $date_oral_intermediaire)),
            'dossier_intention' => array('name' => 'Dossier d\'intention', 'date' => '28 mai', 'day_left' => $this->get_nb_open_days($today, $date_dossier_intention)),
            'dossier_technique' => array('name' => 'Dossier technique', 'date' => '11 juin', 'day_left' => $this->get_nb_open_days($today, $date_dossier_technique)),
            'oral' => array('name' => 'Oral', 'date' => '23 juin', 'day_left' => $this->get_nb_open_days($today, $date_oral)),
        );

        return $dates;
    }
}