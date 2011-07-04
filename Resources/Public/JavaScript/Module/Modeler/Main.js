Ext.define('ExtensionBuilder.Module.Modeler.Main', {
	extend: 'ExtensionBuilder.Module.AbstractModule',
	alias: 'widget.ExtensionBuilder.Module.Modeler.Main',
	id: 'ExtensionBuilder.Module.Modeler.Main',

	initComponent: function() {
		Ext.apply(this, {});

		this.callParent(arguments);
	}


});

ExtensionBuilder.Core.registerModule('ExtensionBuilder.Module.Modeler.Main', 'Modeler');