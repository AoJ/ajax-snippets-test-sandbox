<?php

/**
 * My Application
 *
 * @copyright  Copyright (c) 2010 John Doe
 * @package    MyApplication
 */

/**
 * Homepage presenter.
 *
 * @author     John Doe
 * @package    MyApplication
 */
class DefaultPresenter extends BasePresenter
{

	public function createComponentForm($name)
	{
		$form = new Nette\Application\AppForm($this, $name);
		$form->addSubmit('refresh_me', 'Refresh all snippets');
		$form->addSubmit('refresh_x', 'Refresh snippet X');
		$form->addSubmit('refresh_y', 'Refresh snippet Y');
		$form->addSubmit('refresh_com', 'Refresh all controls');
		$form->addSubmit('refresh_a', 'Refresh control A');
		$form->addSubmit('refresh_b', 'Refresh control B');
		$form->getElementPrototype()->addClass('ajax');
		$form['refresh_me']->onClick[] = callback($this, 'handleRefresh');
		$form['refresh_com']->onClick[] = callback($this, 'handleRefreshCom');
		$form['refresh_a']->onClick[] = callback($this['a'], 'handleRefresh');
		$form['refresh_b']->onClick[] = callback($this['b'], 'handleRefresh');
		$form['refresh_x']->onClick[] = callback($this, 'handleRefreshX');
		$form['refresh_y']->onClick[] = callback($this, 'handleRefreshY');
	}

	public function createComponentA($name)
	{
		$control = new FooWidget($this, $name);
		$control->nested = true;
	}

	public function createComponentB($name)
	{
		$control = new FooWidget($this, $name);
	}

	public function handleRefresh()
	{
		 $this->handleRefreshX();
		 $this->handleRefreshY();
	}
	
	public function handleRefreshCom()
	{
		 foreach (array('a','b','dyna1','dyna2','dyna3','dyna4','dyna5') as $name) {
			 $this[$name]->invalidateControl();
		 }
	}
	
	public function handleRefreshX()
	{
		$this->invalidateControl('example');
	}
	
	public function handleRefreshY()
	{
		$this->invalidateControl('dynamic');
	}

	public function createComponent($name)
	{
		if (preg_match("/^dyna/", $name)) {
			$control = new FooWidget($this, $name);
		} else {
			return parent::createComponent($name);
		}
	}

}
