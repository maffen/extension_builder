<?php

/**
 * Description
 *
 * @AggregateRoot
 */
class Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Extension {

	/**
	 * @var string
	 * @validate(type = 'length', min = 2)
	 * @validate(type = 'format', matcher = '/^[a-z]{2,10}/')
	 */
	protected $key;

	/**
	 * @var string
	 * @label
	 */
	protected $name;

	/**
	 * @var array
	 * @list({'Frontend','Backend'})
	 */
	protected $category;

	/**
	 * @var string
	 * @list({'Alpha','Beta','Test','Stable'})
	 */
	protected $state;

	/**
	 * @var array<Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Person>
	 */
	protected $person;

	/**
	 * @var array
	 * @OneToMany(targetEntity = 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Plugin')
	 */
	protected $plugin = array();

	/**
	 * @var array
	 * @OneToMany(targetEntity = 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Module')
	 */
	protected $module = array();

}

?>