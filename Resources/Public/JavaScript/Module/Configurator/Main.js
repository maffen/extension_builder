Ext.define('ExtensionBuilder.Module.Configurator.Main', {
	extend: 'ExtensionBuilder.Module.AbstractModule',
	alias: 'widget.ExtensionBuilder.Module.Configurator.Main',

	initComponent: function() {

		var tree = Ext.create('Ext.tree.Panel', {
			xtype: 'treepanel',
			columnWidth: 1/3,
			title: 'Simple Tree',
			height: 500,
			store: ExtensionBuilder.Core.DataStore,
			rootVisible: true,
			dockedItems: [{
				xtype: 'toolbar',
				items: [{
					text: 'Expand All',
					handler: function(){
						tree.expandAll();
					}
				}, {
					text: 'Collapse All',
					handler: function(){
						tree.collapseAll();
					}
				}]
			}]
		});

		Ext.apply(this, {
			layout: 'column',
			items: [
				tree,
				{
					xtype: 'panel',
					columnWidth: 2/3,
					title: 'form'
				}
			]
		});

		this.callParent(arguments);
	}

});

ExtensionBuilder.Core.registerModule('ExtensionBuilder.Module.Configurator.Main', 'Configurator');