Ext.define('ExtensionBuilder.Components.UserInterface.Layout', {
	extend: 'Ext.container.Container',
	alias: 'widget.ExtensionBuilder.Components.UserInterface.Layout',

	initComponent: function() {
		Ext.apply(this, {
			height: '100%',
			layout: 'fit',
			items: [{
				xtype: 'ExtensionBuilder.Components.UserInterface.TabPanel'
			}]
		});

		this.callParent(arguments);
	}
});

ExtensionBuilder.Core.on('init', function() {
	Ext.create('ExtensionBuilder.Components.UserInterface.Layout', {
		renderTo: 'typo3-docbody'
	});
});