$.fn.animateRotate = function(angle, duration, easing, complete) {
  var args = $.speed(duration, easing, complete);
  var step = args.step;
  return this.each(function(i, e) {
    args.complete = $.proxy(args.complete, e);
    args.step = function(now) {
      $.style(e, 'transform', 'rotate(' + now + 'deg)');
      if (step) return step.apply(e, arguments);
    };

    $({deg: 0}).animate({deg: angle}, args);
  });
};

$(document).ready(function()
{
	$(".player_container").hide();

	$('body').bind('touchmove', function(e){e.preventDefault()})

	$(".logo").addClass("animated bounceInDown");
	$(".content_bottom").addClass("animated bounceIn");

	setTimeout(function()
	{
		$(".logo").removeClass("animated bounceInDown");
		$(".content_bottom").removeClass("animated bounceIn");		
	}, 1000);

	$(".buttons button").click(function()
	{
		$(".indexContent").hide("slide", {direction : 'left'}, 1000, function()
		{
			$("body").css({overflow : 'hidden'});
			$(".page").animateRotate(90, null, null, function()
			{
				// Hook up ACE editor to all textareas with data-editor attribute
				$(function () {
					$('textarea[data-editor]').each(function () {
					    var textarea = $(this);
					    var mode = textarea.data('editor');
					    var editDiv = $('<div>', {
					        position: 'absolute',
					        width: textarea.width(),
					        height: textarea.height(),
					        'class': textarea.attr('class')
					    }).insertBefore(textarea);
					    textarea.css({visibility : 'hidden', width : '0px', height : '0px'});
					    var editor = ace.edit(editDiv[0]);
					    editor.renderer.setShowGutter(true);
					    editor.getSession().setValue(textarea.val());
					    editor.getSession().setMode("ace/mode/" + mode);
					    editor.setTheme("ace/theme/solarized_dark");
					    
					    // copy back to textarea on form submit...
					    textarea.closest('form').submit(function () {
					        textarea.val(editor.getSession().getValue());
					    })
					});
				});

				$(this).css({background : 'none', width : $(window).width(), height : $(window).height(), transform : 'rotate(0deg)'});

				$(".left").addClass("animated slideInLeft").show();
				$(".right").addClass("animated slideInRight").show();

				setTimeout(function()
				{
					$("body").css({overflow : 'auto'});
				}, 1000);
			});
		});
	});
});

$(document).bind('keydown', function(e) 
{
	if( e.ctrlKey && (e.which == 83) ) 
	{
		e.preventDefault();
		return false;
	}
});