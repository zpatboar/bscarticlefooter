<?php
/**
 * @copyright	Copyright (C) 2012-2013 Boarman Service Company, LLC. All rights reserved.
 * @license	GNU General Public License version 2 or later;
 */

defined('_JEXEC') or die;

jimport( 'joomla.plugin.plugin' );

class plgContentBSCArticleFooter extends JPlugin
{

	public function onContentPrepare($context, &$article, &$params)
	{
                $option = JRequest::getCmd('option');
                $view = JRequest::getCmd('view');
				
                if ($option == 'com_content' && ( ( $context == 'com_content.article' && $view = 'article' && $this->isCategoryRight() ) OR ($this->params->get('frontpage') == 'yes' && $context == 'com_content.featured' && $view = 'featured') OR ($this->params->get('categoryblog') == 'yes' && $context == 'com_content.category' && $view = 'blog') ) ){//without $context shows for mod_custom, doesn't hurt to check.
        		// Get the footer
        		$footer = $this->params->get('text');
        		$footer = trim($footer);
                        $article->text .= $footer;
                }
	}

        private function isCategoryRight(){
                $db = JFactory::getDBO();
                 $db->setQuery('SELECT catid FROM #__content WHERE id = '.JRequest::getInt('id'));
                 $catid = $db->loadResult();
                 $categories = (array) $this->params->get('category');
                 if ( in_array($catid,$categories) ){
                        return true;
                } else {
                        return false;
                }
        }

}
