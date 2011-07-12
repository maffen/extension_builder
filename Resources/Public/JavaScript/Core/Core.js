Ext.define('ExtensionBuilder.Core', {
	singleton: true,
	extend: 'Ext.util.Observable',

	constructor: function(config){
		this.addEvents({
			'pre-init': true,
			init: true
		});

		this.callParent(arguments);
	},

	initialize: function() {
		this.fireEvent('pre-init');
		this.fireEvent('init');
	},

	_modules: [],

	registerModule: function(alias, label) {
		this._modules.push({alias: alias, label: label});
	},

	getModules: function() {
		return this._modules;
	}

});

Ext.onReady(function() {
	ExtensionBuilder.Core.initialize();
	Ext.QuickTips.init();
});