/**
 * 地区联动插件,基于jquery
 * Last Update:2012-7-17
 */

ol.pkg("ec.linkSelect");

(function(){
	var data ;
	var query ;
	var init = function () {
		data = ol.linkSelect.data;
		query = function(id , usecache , callback){
			var json = data[id] ? data[id] : false;
			if(callback && ol.util.isFunction(callback)) {
				callback(json);
			}
		};
	};

	if(ol.linkSelect.data){
		init();
	} else {
		setTimeout(init, 200);
	}

	ol.linkSelect.regionFn = function(selector , opt){
		var
		$ = jQuery,
		defaultValues = [],
		options = $.extend(true , {}, ol.linkSelect.region.setting, opt),
		jq_selector = $(selector),
		_container,
		_selects , //所有select

		//构造select
		renderSelect = function(index , data){

			var node;
			//构造select
			var html = ["<select "] , tmp;

			if(options.ids && index < options.ids.length && (tmp = options.ids[index])) html.push('id="'+tmp+'"');
			if(options.names && index < options.names.length && (tmp = options.names[index])) html.push('name="'+tmp+'"');
			if(options.css && index < options.css.length && (tmp = options.css[index])) html.push('class="'+tmp+'"');
			html.push(" />");

			var select = $(html.join(""));

			html = [];
			if(options.tips && index < options.tips.length) {
				html.push('<option value="">'+options.tips[index]+'</option>'); 
			}
			//构造option
			for(key in data) {
				html.push('<option value="'+ key +'">'+ data[key] +'</option>');
			}

			//绑定事件
			select.html(html.join("")).change(function(){
				var id = '0,'+ ((index > 0) ? _selects[0].val()+',' : '')  + $(this).val();
				_getChildren(index , id);
			});

			//设置默认值
			if(defaultValues.length > 0) {
				select.val(defaultValues[0]);
				defaultValues.splice(0, 1);
			}
			return select;
		},

		_getChildren = function(index , value){
			if(index > 1) return;
			var removeIndex = index +1;
			while(removeIndex < _selects.length)
			{
				//移除子类节点
				_selects[removeIndex].remove();
				_selects.splice(removeIndex , 1);
			}
			query(value , true , function(json){
					//无子节点
					if(!json) {
						if(options.onchange)options.onchange.call(_selects[index][0] , value);
						return;
					}
					index = index +1;

					var select = renderSelect(index , json);
					_selects.push(select);
					_container.append(select);
					//触发子节点事件
					select.change();
			});

		},
		_getDefaultVal = function (val) {
			if(!val) return false;

			var list;
			for (key in data) {
				list = data[key];
				for (id in list) {
					if(val == id) {
						defaultValues = key.split(',');
						defaultValues.push(""+ val);
						defaultValues.splice(0, 1);
						return ;
					}
				}
			}
		};

		this.init = function(){

			_selects = [];
			_container = $("<span class='iss_linkSelect iss_linkSelect_region' />");

			query(0, true, function(json){

				var html = [] , sub , node , select;

				//设置默认值
				_getDefaultVal(options.defaultValue);

				select = renderSelect(0 , json);

				_selects.push(select);
				_container.append(select);

				_selects[_selects.length -1 ].change();
				jq_selector.empty().append(_container);
			});
		};//init end

		//重置
		this.reset = function(){
			var thix = this;
			setTimeout(function(){
				thix.init();
			},100);

		};//reset end

		//设置默认值
		this.setValue = function(value){
			options.defaultValue = value;
			this.init();
		};//setValue end

		this.init();
	};

	if(ol.linkSelect.data){
		ol.linkSelect.region = ol.linkSelect.regionFn;
	} else {
		ol.linkSelect.region = function(selector , opt){
			setTimeout(function (){
				ol.linkSelect.regionFn(selector , opt);
			}, 200);
		};
	}
})();

ol.linkSelect.regionFn.setting = {
	defaultValue : 0,
	css : null,
	ids : null,
	names : null,
	tips : null,
	onchange : null
};