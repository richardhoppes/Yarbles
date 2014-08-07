<?
use \yarbles\framework\common\YarblesLocator;

// External libraries
include_once(YarblesLocator::getConfig()->getProperty('fw_path') . "/michelf/PHPMarkdownExtra/markdown.php");
include_once(YarblesLocator::getConfig()->getProperty('fw_path') . "/michelf/PHPSmartyPants/smartypants.php");
include_once(YarblesLocator::getConfig()->getProperty('fw_path') . "/ajaxray/UniversalFeedGenerator/FeedWriter.php");
include_once(YarblesLocator::getConfig()->getProperty('fw_path') . "/ajaxray/UniversalFeedGenerator/FeedItem.php");