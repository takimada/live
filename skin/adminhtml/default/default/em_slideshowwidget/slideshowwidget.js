/**
 * EM SlideshowWidget
 *
 * @license commercial software
 * @copyright (c) 2012 Codespot Software JSC - EMThemes.com. (http://www.emthemes.com)
 */
 
 
	function del(code){
		var id	=	code.id.replace(/del_control/i, "");
		$(id+'label').innerHTML = 'Not Selected';
		$(id+'value').value = '';		
		
	}