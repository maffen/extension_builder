Ext.define('ExtensionBuilder.Components.UserInterface.TabPanel', {
	extend: 'Ext.tab.Panel',
	alias: 'widget.ExtensionBuilder.Components.UserInterface.TabPanel',

	initComponent: function() {

		Ext.apply(this, {
			height: '100%',
			padding: 0
		});

		this.on('afterrender', function() {
			var modules = ExtensionBuilder.Core.getModules();
			//console.log(modules);
			Ext.each(modules, function(module) {
				this.add({
					xtype: module.alias,
					title: module.label
				});
			}, this);
			this.setActiveTab(2);
		}, this);

		this.callParent(arguments);
	}
});