

var inputTags = ['INPUT','TEXTAREA','SELECT'];

// I thought I needed it, but I didn't need it anymore,
// but I already implemented it. So, here we go, if you
// ever would need a Javascript camelize implementation
// you can freely use this :-).
 
//  - vjt@openssl.it  Tue Feb 15 16:49:52 CET 2011
 
jQuery.extend (String.prototype, {
  camelize: function () {
    return this.replace (/(?:^|[-_])(\w)/g, function (_, c) {
      return c ? c.toUpperCase () : '';
    })
  }
});

function inputFilter() {
	// getter/setter method pseudocode:
	// gets the class of the input type (class='input TYPE ...')
	// then checks it against each key in the filters array and calls the specified method
	this.filters = {
		text: {
			'set': this.textSet,
			'get': this.textGet
		},
		datetime: {
			'set': this.textSet,
			'get': this.textGet
		},
		date: {
			'set': this.textSet,
			'get': this.textGet
		},
		select: {
			'set': this.textSet,
			'get': this.textGet
		},
		enum: {
			'set': this.textSet,
			'get': this.textGet
		}
	};
	
	this.textSet = function(el, val) {
		$(el).find("input").val(val);
	}
	
	this.textGet = function(el) {
		return $(el).val();
	}
}

function iframeLoad(srcForm, srcIndex, ajaxIframe, currentContext, parentContext) {
	if ($('#' + ajaxIframe + currentContext.substr(1)).contents().find(srcForm).length) {
		$(currentContext + ' ' + srcForm).remove();
		$(currentContext).prepend($('#' + ajaxIframe + currentContext.substr(1)).contents().find(srcForm));
	} else if ($('#' + ajaxIframe + currentContext.substr(1)).contents().find(srcIndex).length) {
		console.log('form sin error');
		$(parentContext + ' > *').remove();
		$(parentContext).prepend($('#' + ajaxIframe  + currentContext.substr(1) ).contents().find(srcIndex));
		eval($('#' + ajaxIframe  + currentContext.substr(1) ).contents().find('script').last().text());
		$('.popup' + currentContext).remove();
		if ($('.popup').length == 0) {
			$('.ajaxloading').dialog('close');
		}
	}
} 


function fillEntityFromID(url, containerSelector, addFunction) {
	$.ajax({
		url: url,
		success: function(data) {
			fillEntityFromView(data, containerSelector, addFunction);
		}
	});
}

function fillEntityFromView(entity, containerSelector, addFunction) {
	if (addFunction == "append") {
		$(containerSelector).append(unwrapForm(entity));
		incIdx(containerSelector);
	} else if (addFunction == "prepend") {
		$(containerSelector).prepend(unwrapForm(entity));
		incIdx(containerSelector);
	} else if (addFunction == "html") {
		$(containerSelector).html(unwrapForm(entity));
	}
	
}

function fillEntityFromJson(entity, pathIdPrefix, association, alias) {
	for (key in entity) {
		fieldid = pathIdPrefix + alias + key.camelize();
		
		if ( $.type(entity[key]) == 'object' || $.type(entity[key]) == 'array') {
			
		} else {
			obj = $('#'+fieldid);
			console.log(obj);
			if (obj.length) {
				console.log(obj.prop("tagName"));
				console.log(inputTags);
				if ( $.inArray(obj.prop("tagName"), inputTags) > -1) {
					obj.val(entity[key]);
				} else {
					obj.html(entity[key]);
				}
			}
		}
		
		
	}
}

function incIdx(selector, innerselector) {
	if (undefined != innerselector) {
		curval = parseInt($(selector).find(innerselector).first().data('listindex'));
	} else {
		curval = parseInt($(selector).data('listindex'));
	}
	
	curval = curval + 1;

	if (undefined != innerselector) {
		$(selector).find(innerselector).first().data('listindex', curval);
	} else {
		$(selector).data('listindex', curval);
	}

}

function undoChanges(el) {
	id = el.data("id");
	if (id) {
		// reload the form and replace the recieved data
		url = el.data("url");
		
		$.ajax({
			url: url,
			success: function(data) {
				el.replaceWith(data);
			}
		});
	}
}

function cancelChanges(el) {
	el.find('.element-view').each(function(i,val) {
		$(val).closest('.field-mode-hybrid');
	});
}

function acceptChanges(el) {
	el.find('.element-edit').each(function(i,val) {
		// get value from field, based on the inputFilter methods
		var field = $(val).find('input,textarea');
		var value;
		
		if (field.prop('tagName') == "TEXTAREA") {
			value = field.val();
		} else {
			if (field.prop('type') == "text" || field.prop('type') == 'hidden') {
				value = field.val();
			} else if (field.prop('type') == "select") {
				value = field.find('option:selected').text();
			}
		}
		
		$(val).closest('.field-mode-hybrid').find('.element-view .field .value span').html(value);
	});
	
	$(el).removeClass('editing');
}

function addNewInline(context) {
	
}

function unwrapForm(el) {
	var d;
	if (el instanceof jQuery) {
		//console.log("entra");
		d = el.wrap("<span></span>").parent();
	} else {
		d = $('<span>' + el + '</span>');
	}
	
	//r.append('<span></span>');
	d.find('.submit').remove();
	d.find('input[name=_method]').parent().remove();
	d.find('form > *').appendTo(d);
	d.find('form').remove();
	d = d.find("> *").unwrap();
	
	return d;
}

var inputFilter;

$(document).ready(function() {
	if (!(self == top)) {
		top.iframeLoad(top.srcForm, top.srcIndex, top.ajaxIframe, top.currentContext, top.parentContext);
	}
	/*$('.shadowDark').boxShadow(5,5,5,'#888');
	$('.shadowSoft').boxShadow(5,5,5,'#bbb');
	*/
	$(".clearme").clearme();
	$("input[type=password].clearme").prop("type", "text").addClass('oldpassword');
	$("input[type=text].oldpassword").focus(function(e) { $(e.currentTarget).prop("type", "password"); });
	
	$(".error-message").parents('form').find('.error-message-generic').css('display', 'block');
	
	$('.autohide.left').each(function(i,el) {
		$(el).data('originalWidth', $(el).width());
		$(el).css('width', '1px');
		$(el).mouseenter(function() { $(this).animate({'width': $(this).data('originalWidth')+'px'}); });
		$(el).mouseleave(function() { $(this).animate({'width': '1px'}); });
	});
	
	inputFilter = new inputFilter();
});
