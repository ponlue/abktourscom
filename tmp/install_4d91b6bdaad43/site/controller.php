<?php
/**
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_1
 * @license    GNU/GPL
 */
 
// No direct access
 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport('joomla.application.component.controller');
 
/**
 * Hello World Component Controller
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class HelloController extends JController
{
    /**
     * Method to display the view
     *
     * @access    public
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
    function display()
    {
        parent::display();
    }
 
}