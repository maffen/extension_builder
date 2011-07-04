Ext.define('ExtensionBuilder.Module.Introduction.Main', {
	extend: 'ExtensionBuilder.Module.AbstractModule',
	alias: 'widget.ExtensionBuilder.Module.Introduction.Main',
	id: 'ExtensionBuilder.Module.Introduction.Main',

	initComponent: function() {
		Ext.apply(this, {
			padding: 20,
			height: '100%',
			html: [
				'<p class="bodytext">Welcome to the <b>Extension Builder</b>! This page is intended to give you some',
				'overview about the workflow we suggest.</p><h2>What is this extension builder about?</h2>',
				'<ul><li>This extension builder helps you to build and manage applications based on <b>Extbase</b> and ',
				'<b>Fluid</b>.</li><li>We also want to provide a learning tool for <b>Domain-Driven Design</b></li></ul>',
				'<h2>Domain Driven Design</h2>View <a href="http://www.infoq.com/presentations/model-to-work-evans" ',
				'target="_blank">Putting the Model to Work and Strategic Design</a> by Eric Evans to get an introduction ',
				'into Domain Driven Design (DDD).<h2>Domain Modelling</h2>At first, you will start creating your ',
				'<b>Domain Model</b> with a graphical editor. This editor will do the following for you:<ul><li>',
				'<b>Extension Skeleton</b>: will create the extension directory structure needed</li><li><b>Domain Model',
				'</b>: Will create basic classes for the Domain Model, residing under Domain/Model/</li><li><b>Database ',
				'Tables and TCA</b>: Will create Database Tables and TCA definitions which fit to the domain model.</li>',
				'<li><b>Skeleton Locallang Files</b>: Will create skeleton locallang files</li><li><b>Plugin Configuration',
				'</b>: Will create a plugin configuration, so it will work out-of-the-box.</li><li><b>Dynamic Scaffolding',
				'</b>: Automatically create all CRUD actions (Create, Read, Update, Delete) for Aggregate Roots!</li></ul>',
				'Have a look at the Wiki <a href="http://forge.typo3.org/projects/extension-extension_builder/wiki/Using',
				'_the_Kickstarter" target="_blank" style="color:blue;text-decoration:underline;">Using the Extension Bui',
				'lder</a> for more details.<br /><br /><p><b><f:link.action action="domainmodelling" style="color:blue;t',
				'ext-decoration:underline;">Go to the Domain Modeller</f:link.action></b></p><h2>Iterative model refinem',
				"ent</h2>The first version of the model will usually not be the one you'll use lateron. That's why you s",
				'hould take your time, and improve your model.<br />Useful things to know:<ul><li><b>Dynamic Scaffolding',
				'</b>: The Scaffolding will automatically adjust the templates needed to render CRUD-functionality for y',
				'our domain models. That is, if you modify your domain model by adding or removing fields, the standard ',
				'CRUD actions display the new fields as well.</ul>When you start to modify the generated files, but stil',
				'l want to use the graphical modeler to extend your model, you have to enable the roundtrip feature in t',
				'he Extension Builder settings in the Extension Manager. <br /> You will find a file in your extension d',
				'irectory Configuration/ExtensionBuilder/settings.yaml.<br />There you can configure which files should ',
				'be overwritten, kept or merged if you save your model.<br />A good practice would be, to let the Extens',
				'ion Builder generate the Partials for form fields and properties for you and include them in your templ',
				'ates.<br /><br />At the Wiki <a href="http://forge.typo3.org/projects/extension-extension_builder/wiki/',
				'Modifying_and_extending_the_model" target="_blank" style="color:blue;text-decoration:underline;">Modify',
				'ing and extending the model</a> you find more details about this feature'
			].join('')
		});

		this.callParent(arguments);
	}
});

ExtensionBuilder.Core.registerModule('ExtensionBuilder.Module.Introduction.Main', 'Introduction');