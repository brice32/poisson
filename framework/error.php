<?php
/**
 * Created by PhpStorm.
 * User: wangy
 * Date: 28/11/2016
 * Time: 15:36
 */

namespace F3il;

class Error extends \Exception{

    const DEBUG = 'debug';
    const PRODUCTION = 'production';

    protected $explanation;
    protected $runMode;

    /**
     *
     * Error constructor. par \exception
     * Si configuration n'a pas charge,return production
     * si configuration charge run_mode = debug,return debug
     * sinon return produiction
     * @param string $message
     */
    public function __construct($message) {

        parent::__construct($message);
        if(Configuration::isLoaded()){
            $conf=Configuration::getInstance();

            if($conf->run_mode==self::DEBUG){
                $this->runMode = self::DEBUG;
            }
            else {
                $this->runMode =  self::PRODUCTION;
            }
        }
        else{
            $this->runMode =  self::PRODUCTION;
        }


//        $this->runMode = $conf->run_mode;
//        if (is_null($conf)) {
//            return PRODUCTION;
//        } else if ($this->runMode == DEBUG) {
//            return DEBUG;
//        } else {
//            return PRODUCTION;
//        }
    }

    public function __toString() {
        // TODO: Implement __toString() method.
        ob_end_clean();
        if ($this->runMode == self::DEBUG) {
            $this->productionRender();
        } else if ($this->runMode == self::PRODUCTION) {
            $this->debugRender();
        } else {
            die('error.php $this->runMode erreu!' . $this->runMode);
        }
    }

    private function productionRender() {
        echo "<h1>OUPS<h1>";
    }

    public function debugRender() {
        $trace = $this->getTrace();
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <title>Erreur dans l'application</title>
                <meta charset='utf-8'>
            </head>
            <body>
                <h1>Erreur</h1>
                <p><?php echo $this->message; ?></p>
        <?php if ($this->explanation): ?>
                    <p>Explications : <?php echo $this->explanation; ?></p>
        <?php endif; ?>
                <p>Fichier : <?php echo $this->file; ?></p>
                <p>Ligne : <?php echo $this->line; ?></p>
                <p>Fonction : <?php echo $trace[0]['class'] . '::' . $trace[0]['function']; ?></p>
                <pre><?php echo $this->getTraceAsString(); ?></pre>
            </body>
        </html>
                <?php
            }

        }
        