Ext.define('ExtensionBuilder.Module.Localization.Main', {
	extend: 'ExtensionBuilder.Module.AbstractModule',
	alias: 'widget.ExtensionBuilder.Module.Localization.Main',
	id: 'ExtensionBuilder.Module.Localization.Main',
	layout:'border',
	defaults: {
	    collapsible: true,
	    split: true,
	},
	items: [{
			title: 'Language',
			region:'west',
			width: 175,
			minSize: 100,
			maxSize: 250,
			margins: '0 5 0 0',
			items: [
				{
					title:'New Language',
					html:'<label>New empty model</label><button style="float:right">Add</button>',
					preventHeader:true,
					cls:'addModel',
					style:{
						margin:'10px 0'
					}
				}
			]
		},{
			title: 'Properties',
			region:'east',
			width: 175,
			minSize: 100,
			maxSize: 250,
			layout: {
				type: 'accordion',
				animate: true
			},
			collapsed: true
		},{
			title: 'Label',
			collapsible: false,
			collapsed:false,
			region:'center',
			margins: '5 0 0 0',
	}]
});

ExtensionBuilder.Core.registerModule('ExtensionBuilder.Module.Localization.Main', 'Localization');