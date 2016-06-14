<?php namespace Widgit\Lib;

class Plugin extends Curl{
    private $curl;
    private $url;
    private $extracted = array();
    private $widgetStr;
    private $repoAmount;
    private $styleLocation;

    public function __construct($username, $num) {
        $this->styleLocation = "<link href=".getcwd ( )."/view/css/widgit.css></link>";
        $this->url = "https://api.github.com/users/" .$username . "/repos?sort=updated";
        $this->repoAmount = $num;
        $this->curl = new Curl();
    }

    public function getData($isArray) {
        $val = $this->curl->getCurlData($this->url);
        $i = 0;
        if($isArray) {
            if($val) {
                $keys = array("name", "full_name", "language", "fork", "html_url", "avatar_url");

                foreach($val as $item) {
                    foreach($keys as $option) {
                        $this->extracted[$i][$option] = $option != "avatar_url"
                            ? $this->extracted[$i][$option] = $item[$option]
                            : $this->extracted[$i][$option] = $item["owner"][$option];
                    }
                    $i++;
                }


            }
            $this->buildWidgetString();
            $this->appendHTMLElement("ul");
            $this->prependOcticon();
            return $this->widgetStr;
        } else {
            return "";
        }
    }

    public function appendHTMLElement($elem = null) {
        $this->widgetStr =  "<" . $elem . " class='widget-list'>" . $this->widgetStr;
        if($elem){
            $this->widgetStr .= "</" . $elem. ">";

        }

    }

    public function prependOcticon() {
        $this->widgetStr = "<link rel='stylesheet'  href=https://cdnjs.cloudflare.com/ajax/libs/octicons/3.5.0/octicons.css
            >". $this->styleLocation . $this->widgetStr;
    }
    public function buildWidgetString() {
        $this->widgetStr = "";
        $this->extracted = array_slice($this->extracted, 0, $this->repoAmount);
        if(!is_string($this->extracted)) {
            foreach($this->extracted as $key => $value) {
                $icon = $this->extracted[$key]["fork"] == true ? 'octicon octicon-repo-forked icon' : 'octicon octicon-repo icon';
                $this->widgetStr .= "<a target=__blank href=" . $this->extracted[$key]["html_url"] .
                    "><li><span class='" . $icon . "'></span>" . $this->extracted[$key]["name"]."" .
                    "<span class='language'>" .$this->extracted[$key]["language"] . "</span></li></a>";

            }
        }

    }


}