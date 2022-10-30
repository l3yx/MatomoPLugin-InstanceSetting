<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\InstanceSetting;
use Piwik\SettingsPiwik;
use Piwik\Config;
use Piwik\Piwik;
use Piwik\Common;


/**
 * A controller lets you for example create a page that can be added to a menu. For more information read our guide
 * http://developer.piwik.org/guides/mvc-in-piwik or have a look at the our API references for controller and view:
 * http://developer.piwik.org/api-reference/Piwik/Plugin/Controller and
 * http://developer.piwik.org/api-reference/Piwik/View
 */
class Controller extends \Piwik\Plugin\ControllerAdmin
{
    public function index()
    {
        return $this->renderTemplate('index', array(
            'instance_id' => SettingsPiwik::getPiwikInstanceId()
        ));
    }

    public function save()
    {
        Piwik::checkUserHasSuperUserAccess();

        $instance_id = Common::getRequestVar('instance_id', '', 'string');
        Config::setSetting('General', 'instance_id', $instance_id);
        Config::getInstance()->forceSave();

        return $this->renderTemplate('index', array(
            'instance_id' => SettingsPiwik::getPiwikInstanceId()
        ));
    }
}
