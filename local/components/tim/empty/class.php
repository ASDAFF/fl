<?

/**
 * Пустой компонент
 */
class EmptyComponent extends \CBitrixComponent
{
	/**
	 * @inherit
	 */
	public function executeComponent()
	{
		$this->includeComponentTemplate();
	}
}
