Ext.define('ExtensionBuilder.Module.Configurator.Main', {
	extend: 'ExtensionBuilder.Module.AbstractModule',
	alias: 'widget.ExtensionBuilder.Module.Configurator.Main',
	initComponent: function() {

		var tree = Ext.create('Ext.tree.Panel', {
			xtype: 'treepanel',
			collapsible: true,
			title: 'Model',
			height: 290,
			store: ExtensionBuilder.Core.ConfigStore,
			rootVisible: true,
			listeners: {
				itemclick: function(v,record, item,index, e) {
					modelForm.hide();
					propertyForm.hide();
					relationForm.hide();
					if(record.raw.leaf){
						if(typeof record.raw.property != 'undefined'){
							propertyForm.show();
							propertyForm.setTitle('Configuration for ' + record.raw.text);
						} else {
							relationForm.show();
							relationForm.setTitle('Configuration for ' + record.raw.text);
						}
					} else {
						modelForm.setTitle(record.raw.text + ' Model');
						modelForm.show();
					}
				}
			},
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
				{
					xtype: 'panel',
					title: 'Configuration',
					preventHeader:true,
					columnWidth: .3,
					defaults: {
						collapsible:true
					},
					items: [
						tree,
						{
							title:'Persons (1)'
						},
						{
							title:'Plugins (2)'
						},
						{
							title:'Backend-Modules (1)'
						},
						{
							title:'Services (0)'
						},
						{
							title:'Advanced Configuration',
							items:[
								{
									title:'Additional tables',
								}
							]
						}
					]
				},
				{
					xtype: 'panel',
					columnWidth: .7,
					title: 'Form',
					preventHeader:true,
					border:false,
					items:[
						modelForm,
						propertyForm,
						relationForm
					]
				}
			]
		});

		this.callParent(arguments);
	}

});

ExtensionBuilder.Core.registerModule('ExtensionBuilder.Module.Configurator.Main', 'Configurator');