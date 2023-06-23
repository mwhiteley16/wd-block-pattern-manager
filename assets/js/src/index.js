/*
 * WordPress dependencies
 */
const { registerPlugin } = wp.plugins;
const { PluginDocumentSettingPanel } = wp.editPost;
const { ToggleControl, TextControl, CheckboxControl } = wp.components;
const { useDispatch, useSelect, select } = wp.data;
const { compose } = wp.compose;
const { __ } = wp.i18n;

/*
 * Post Types panel
 */
const PostTypesPanel = () => {

	// Set up useDispatch to save post meta on post edit.
	const { editPost } = useDispatch('core/editor');

	// Get meta from current post.
	const meta = useSelect((select) => select('core/editor').getEditedPostAttribute('meta'));

	// Get all available Post Types to use in the post type selector.
	const postTypes = useSelect((select) => select('core').getPostTypes({}));

	// Only output "public" Post Types. Additionally, exclude "Media".
	const filteredPostTypes = postTypes ? postTypes.filter((postType) => postType.viewable !== false && postType.name !== 'Media') : [];

	console.log(filteredPostTypes);

	// Update meta functionality.
	const updateMeta = (key, value) => {
		const newMeta = { ...(meta || {}), [key]: value };
		editPost({ meta: newMeta });
	};

	return (
		<PluginDocumentSettingPanel
			name="wd-block-pattern-manager-post-types"
			title={__('Select Post Types', 'wd-block-pattern-manager')}
			className="wd-block-pattern-manager-post-types"
		>
			{filteredPostTypes && (
				<>
					<p class="components-base-control__help" style={{ color: 'blue', marginTop: '10px', fontSize: '12px', color: 'rgb(117, 117, 117)' }}>
						{__('Choose what post types you would like this pattern to be available to use in.', 'wd-block-pattern-manager')}
					</p>
					{filteredPostTypes.map((postType) => {
						const checkboxKey = `wd_${postType.slug}_pattern_display`;
						const isChecked = meta && meta[checkboxKey];

						return (
							<CheckboxControl
								key={checkboxKey}
								label={postType.labels.singular_name}
								checked={!!isChecked}
								onChange={(value) => updateMeta(checkboxKey, value)}
							/>
						);
					})}
				</>
			)}			
		</PluginDocumentSettingPanel>
	);
};

/*
 * Pattern Categories panel
 */
const PatternCategoriesPanel = () => {

	// Set up useDispatch to save post meta on post edit.
	const { editPost } = useDispatch('core/editor');

	// Get meta from current post.
	const meta = useSelect((select) => select('core/editor').getEditedPostAttribute('meta'));

	// Get all registered pattern categories.
	const patternCategories = useSelect((select) => select('core').getBlockPatternCategories());

	// Update meta functionality.
	const updateMeta = (key, value) => {
		const newMeta = { ...(meta || {}), [key]: value };
		editPost({ meta: newMeta });
	};

	return (
		<PluginDocumentSettingPanel
			name="wd-block-pattern-manager-categories"
			title={__('Set Pattern Categories', 'wd-block-pattern-manager')}
			className="wd-block-pattern-manager-categories"
		>

			{patternCategories && (
				<>
					<p class="components-base-control__help" style={{ color: 'blue', marginTop: '10px', fontSize: '12px', color: 'rgb(117, 117, 117)' }}>
						{__('Choose what categories you would like this pattern assigned to.', 'wd-block-pattern-manager')}
					</p>
					{patternCategories.map((category) => {
						const checkboxKey = `wd_${category.name}_pattern_category`;
						const isChecked = meta && meta[checkboxKey];

						return (
							<CheckboxControl
								key={category.name}
								label={category.label}
								checked={!!isChecked}
								onChange={(value) => updateMeta(checkboxKey, value)}
							/>
						);
					})}
				</>
			)}
			
		</PluginDocumentSettingPanel>
	);
};

/*
 * Pattern Options panels.
 */
const PatternOptions = () => {

	// Set up useDispatch to save post meta on post edit.
	const { editPost } = useDispatch('core/editor');

	// Get meta from current post.
	const meta = useSelect((select) => select('core/editor').getEditedPostAttribute('meta'));

	// Get current meta if it exists.
	const enablePageCreationPattern = meta && meta.wd_enable_page_creation_pattern;

	// Update meta functionality.
	const updateMeta = (key, value) => {
		const newMeta = { ...(meta || {}), [key]: value };
		editPost({ meta: newMeta });
	};

	return (
		<>
			<PluginDocumentSettingPanel
				name="wd-block-pattern-manager-options"
				title={__('Pattern Options', 'wd-block-pattern-manager')}
				className="wd-block-pattern-manager-options"
			>
				<>
					<p class="components-base-control__help" style={{ color: 'blue', marginTop: '10px', fontSize: '12px', color: 'rgb(117, 117, 117)' }}>
						{__('Use this pattern as a page creation template. ', 'wd-block-pattern-manager')}
						<a href="https://whiteleydesigns.com" target="_blank" rel="noopener noreferrer">{__('Click here', 'wd-block-pattern-manager')}</a>{__(' to learn more about creation patterns.')}
					</p>
					<ToggleControl
						label={__('Page Creation Pattern', 'wd-block-pattern-manager')}
						checked={!!enablePageCreationPattern}
						onChange={(value) => updateMeta('wd_enable_page_creation_pattern', value)}
					/>
				</>
				
			</PluginDocumentSettingPanel>

			<PostTypesPanel />
			<PatternCategoriesPanel />
		</>
	);
};

registerPlugin('wd-block-pattern-manager-panel', {
	render: PatternOptions,
});
