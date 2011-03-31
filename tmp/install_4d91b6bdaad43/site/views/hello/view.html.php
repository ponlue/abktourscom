<?php
/**
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_1
 * @license    GNU/GPL
*/
 
// no direct access
 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport( 'joomla.application.component.view');
 
/**
 * HTML View class for the HelloWorld Component
 *
 * @package    HelloWorld
 */
 
 JToolBarHelper::save();
JToolBarHelper::apply();
JToolBarHelper::cancel();
}
function _DEFAULT() {
JToolBarHelper::title( JText::_( 'Restaurant Reviews' ),
'generic.png' );
JToolBarHelper::publishList();
JToolBarHelper::unpublishList();
JToolBarHelper::editList();
JToolBarHelper::deleteList();
JToolBarHelper::addNew();
 
class HelloViewHello extends JView
{
    function display($tpl = null)
    {
        $greeting = "Hello World!";
        $this->assignRef( 'greeting', $greeting );
 
        parent::display($tpl);
    }
}