Ext.ns('ExtensionBuilder.Core.Ext.data');

Ext.define('ExtensionBuilder.Core.Ext.data.Model', {
	extend: 'Ext.data.Model',

	labelProperty: null,

	get: function(key) {
		if (!this.data.text && this.labelProperty) {
			this.text = this.data.text = this.data[this.labelProperty];
		}
		return this.callParent(arguments);
	}

});