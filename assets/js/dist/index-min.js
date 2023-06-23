"use strict";function _typeof(e){return _typeof="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},_typeof(e)}function ownKeys(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function _objectSpread(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?ownKeys(Object(n),!0).forEach((function(t){_defineProperty(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):ownKeys(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function _defineProperty(e,t,n){return(t=_toPropertyKey(t))in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function _toPropertyKey(e){var t=_toPrimitive(e,"string");return"symbol"===_typeof(t)?t:String(t)}function _toPrimitive(e,t){if("object"!==_typeof(e)||null===e)return e;var n=e[Symbol.toPrimitive];if(void 0!==n){var r=n.call(e,t||"default");if("object"!==_typeof(r))return r;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===t?String:Number)(e)}var registerPlugin=wp.plugins.registerPlugin,PluginDocumentSettingPanel=wp.editPost.PluginDocumentSettingPanel,_wp$components=wp.components,ToggleControl=_wp$components.ToggleControl,TextControl=_wp$components.TextControl,CheckboxControl=_wp$components.CheckboxControl,_wp$data=wp.data,useDispatch=_wp$data.useDispatch,useSelect=_wp$data.useSelect,select=_wp$data.select,compose=wp.compose.compose,__=wp.i18n.__,PostTypesPanel=function(){var e=useDispatch("core/editor").editPost,t=useSelect((function(e){return e("core/editor").getEditedPostAttribute("meta")})),n=useSelect((function(e){return e("core").getPostTypes({})})),r=n?n.filter((function(e){return!1!==e.viewable&&"Media"!==e.name})):[];console.log(r);return React.createElement(PluginDocumentSettingPanel,{name:"wd-block-pattern-manager-post-types",title:__("Select Post Types","wd-block-pattern-manager"),className:"wd-block-pattern-manager-post-types"},r&&React.createElement(React.Fragment,null,React.createElement("p",{class:"components-base-control__help",style:_defineProperty({color:"blue",marginTop:"10px",fontSize:"12px"},"color","rgb(117, 117, 117)")},__("Choose what post types you would like this pattern to be available to use in.","wd-block-pattern-manager")),r.map((function(n){var r="wd_".concat(n.slug,"_pattern_display"),o=t&&t[r];return React.createElement(CheckboxControl,{key:r,label:n.labels.singular_name,checked:!!o,onChange:function(n){return function(n,r){var o=_objectSpread(_objectSpread({},t||{}),{},_defineProperty({},n,r));e({meta:o})}(r,n)}})}))))},PatternCategoriesPanel=function(){var e=useDispatch("core/editor").editPost,t=useSelect((function(e){return e("core/editor").getEditedPostAttribute("meta")})),n=useSelect((function(e){return e("core").getBlockPatternCategories()}));return React.createElement(PluginDocumentSettingPanel,{name:"wd-block-pattern-manager-categories",title:__("Set Pattern Categories","wd-block-pattern-manager"),className:"wd-block-pattern-manager-categories"},n&&React.createElement(React.Fragment,null,React.createElement("p",{class:"components-base-control__help",style:_defineProperty({color:"blue",marginTop:"10px",fontSize:"12px"},"color","rgb(117, 117, 117)")},__("Choose what categories you would like this pattern assigned to.","wd-block-pattern-manager")),n.map((function(n){var r="wd_".concat(n.name,"_pattern_category"),o=t&&t[r];return React.createElement(CheckboxControl,{key:n.name,label:n.label,checked:!!o,onChange:function(n){return function(n,r){var o=_objectSpread(_objectSpread({},t||{}),{},_defineProperty({},n,r));e({meta:o})}(r,n)}})}))))},PatternOptions=function(){var e=useDispatch("core/editor").editPost,t=useSelect((function(e){return e("core/editor").getEditedPostAttribute("meta")})),n=t&&t.wd_enable_page_creation_pattern;return React.createElement(React.Fragment,null,React.createElement(PluginDocumentSettingPanel,{name:"wd-block-pattern-manager-options",title:__("Pattern Options","wd-block-pattern-manager"),className:"wd-block-pattern-manager-options"},React.createElement(React.Fragment,null,React.createElement("p",{class:"components-base-control__help",style:_defineProperty({color:"blue",marginTop:"10px",fontSize:"12px"},"color","rgb(117, 117, 117)")},__("Use this pattern as a page creation template. ","wd-block-pattern-manager"),React.createElement("a",{href:"https://whiteleydesigns.com",target:"_blank",rel:"noopener noreferrer"},__("Click here","wd-block-pattern-manager")),__(" to learn more about creation patterns.")),React.createElement(ToggleControl,{label:__("Page Creation Pattern","wd-block-pattern-manager"),checked:!!n,onChange:function(n){return function(n,r){var o=_objectSpread(_objectSpread({},t||{}),{},_defineProperty({},n,r));e({meta:o})}("wd_enable_page_creation_pattern",n)}}))),React.createElement(PostTypesPanel,null),React.createElement(PatternCategoriesPanel,null))};registerPlugin("wd-block-pattern-manager-panel",{render:PatternOptions});
//# sourceMappingURL=index-min.js.map