<?php

class FooWidget extends \Nette\Application\Control
{
	public $nested = false;

	public function createComponentNested($name)
	{
		$control = new FooWidget($this, $name);
	}

	public function createComponentForm($name)
	{
		$form = new Nette\Application\AppForm($this, $name);
		$form->addSubmit('refresh_me', 'Refresh me');
//		$form->addSubmit('refresh_pres', 'Refresh presenter');
		$form->getElementPrototype()->addClass('ajax');
		$form['refresh_me']->onClick[] = callback($this, 'handleRefresh');
//		$form['refresh_pres']->onClick[] = callback($this->getPresenter(), 'handleRefresh');
	}

	public function render()
	{
		$this->template->setFile(__DIR__ . '/FooWidget.latte');
		$this->template->render();
	}

	public function handleRefresh()
	{
		$this->invalidateControl('example');
	}
}