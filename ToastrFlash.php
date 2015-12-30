<?php

/**
 * @copyright Copyright &copy; Odai Alali 2014
 * @package yii2-toastr
 * @version 0.1-dev
 */

namespace gbksoft\yii2toastr;

use gbksoft\yii2toastr\Toastr;
/**
 * Description of ToastrFlash
 *
 * @author Odai Alali <odai.alali@gmail.com>
 */
class ToastrFlash extends \yii\base\Widget {
    /**
     * @var array the alert types configuration for the flash messages.
     */
    public $alertTypes = [
        'error'   => 'error',
        'danger'  => 'error',
        'success' => 'success',
        'info'    => 'info',
        'warning' => 'warning'
    ];

    public $options = [];

    public function init()
    {
        parent::init();

        $session = \Yii::$app->getSession();
        $flashes = $session->getAllFlashes();

        foreach ($flashes as $type => $data) {
            if (isset($this->alertTypes[$type])) {
                $data = (array) $data;
                foreach ($data as $message) {
                    echo Toastr::widget([
                        'toastType' => $this->alertTypes[$type],
                        'message' => addslashes($message),
                        'options' => $this->options,
                    ]);
                }

                $session->removeFlash($type);
            }
        }
    }
}
