<?php
class UniqueText{

    public function check($text){

        $result = array();
        if ($curl = curl_init()) {
            curl_setopt($curl, CURLOPT_URL, 'http://advego.ru/text/seo/');
            curl_setopt($curl, CURLOPT_AUTOREFERER, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);

            // SOE для meta_keywords
            // if ($model->meta_title) {
            //     curl_setopt($curl, CURLOPT_POSTFIELDS, array('id_lang' => 'ru', 'job_text' => $model->meta_title));
            //     $out = curl_exec($curl);
            //     $a = array();
            //     preg_match_all('/<table cellspacing="1" class="seo_table">.*?<\/table>/sm', $out, $a);
            //     if (!empty($a[0][0]))
            //         if (count($a[0][0]))
            //             $model->meta_title_AT = $this->_getAT($a[0][0]);
            // }
            // SOE для meta_keywords
            // if ($model->meta_keywords) {
            //     curl_setopt($curl, CURLOPT_POSTFIELDS, array('id_lang' => 'ru', 'job_text' => $model->meta_keywords));
            //     $out = curl_exec($curl);
            //     $a = array();
            //     preg_match_all('/<table cellspacing="1" class="seo_table">.*?<\/table>/sm', $out, $a);
            //     if (!empty($a[0][0]))
            //         if (count($a[0][0]))
            //             $model->meta_keywords_AT = $this->_getAT($a[0][0]);
            // }
            // SOE для meta_description
            // if ($model->meta_description) {
            //     curl_setopt($curl, CURLOPT_POSTFIELDS, array('id_lang' => 'ru', 'job_text' => $model->meta_description));
            //     $out = curl_exec($curl);
            //     $a = array();
            //     preg_match_all('/<table cellspacing="1" class="seo_table">.*?<\/table>/sm', $out, $a);
            //     if (!empty($a[0][0]))
            //         if (count($a[0][0]))
            //             $model->meta_description_AT = $this->_getAT($a[0][0]);
            //     if (!empty($a[0][1]))
            //         if (count($a[0][1]))
            //             $model->meta_description_Word = $this->_getWord($a[0][1]);
            // }
            // SOE для content
            if ($text) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, array('id_lang' => 'ru', 'job_text' => preg_replace('/<.*?>/', '', $text)));
                $out = curl_exec($curl);

                // d($out);
                $a = array();
                preg_match_all('/<table cellspacing="1" class="seo_table">.*?<\/table>/sm', $out, $a);
                if (!empty($a[0][0])){
                    if (count($a[0][0])){
                        $result['nausea'] = $this->_getAT($a[0][0]);
                    }
                }
            }
            curl_close($curl);
        }

        return $result;
    }

    private function _getAT($str)
    {
        $b = array ();
        preg_match_all('/<td>.*?<\/td>/sm', $str, $b);
        if (!empty($b[0]))
            return preg_replace('/[^\.0-9]/', '', array_pop($b[0]));
        else
            return 0;
    }

    private function _getWord($str)
    {
        $b = array ();
        $c = array ();
        preg_match_all('/<td.*?>.*?<\/td>/sm', $str, $b);
        if (!empty($b[0]))
        {
            $i = 0;
            do
            {
                if (!empty($b[0][$i]) && !empty($b[0][$i + 2]))
                    $c[preg_replace('/<.*?>/', '', $b[0][$i])] = preg_replace('/<.*?>/', '', $b[0][$i + 2]);
                $i += 3;
            } while ($b[0] && $i < 15);
            return json_encode($c);
        }
        else
            return '';
    }
}

