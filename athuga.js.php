<?

header("Content-type: text/javascript"); 
session_start();
$user=isset($_SESSION['user'])?$_SESSION['user']:null; 
$id=md5(time()); 

?>
var ab;

athuga=function () {

	var qid="#f_"+(id="<?=$id?>");
	var aid="#athuga_"+(id="<?=$id?>");

	var athuga={
		styleSheetCode: "<link rel='stylesheet' type='text/css' href='athuga.css.php?id="+id+"'></link>",
		formCode: "<form onsubmit='return false;' id='f_"+id+"'><textarea id='a_"+id+"' name='comment' placeholder='Let the commentception begin..'></textarea><button id='b_"+id+"'>submit</button></form>",
		loginCode: "<?=!isset($user)?"{$user['displayName']}<br/><a class='button' href='/auth/?t=g&r=#' title='Login'>Login</a>":"<a class='button' title='Logout' href='/auth/?o&t=g&r=#'>Logout</a>"?>",
		commentCode: "<div id='c_"+id+"'/>",
		error: function(x,r) { athuga.comments(); athuga.hook(); },
		commentHook: function() {
			<? if (!isset($user)) { ?>
			return athuga.doLogin();
			<? } ?>
			var formCode=athuga.formCode
			$(qid).remove();
			$(this).after(formCode);
			$(qid).attr('data-id',$(this).attr('data-id'));
			athuga.hook();
		},
		comments: function(r) { 
			$('#c_'+id).html("");
			rid='null';
			$('#athuga_<?=$id?>').after('<div data-parent="q_null" id="q_null" class="c"><div id="r_null" data-id="null" class="r">REPLY</div></div>');
			$('#r_null').click(athuga.commentHook);
			for (i in r) {
				var rid=r[i].id;
				$(qid).unbind('submit');
				$('#c_'+id).after('<div data-parent="q_'+r[i].ownComments_id+'" id="q_'+rid+'" class="c">'+r[i].c+'<div id="r_'+rid+'" data-id="'+rid+'" class="r">REPLY</div></div>');
				$('#r_'+rid).click(athuga.commentHook);
			}
			/* ohyah you know it */
			for (i in r) {
				p=(o=$('#q_'+r[i].id)).attr('data-parent');
				if ($('#'+p)) { $('#'+p).append(o); }
			}
			athuga.hook();
		},
		doLogin: function() {
			login="<div class='a<?=$id?>modal' id='<?=$id?>login'><div class='button' id='a<?=$id?>close'>X</div><div class='a<?=$id?>inner'>Athuga never asks for more then it needs.<br/><br/>Login: <a href='#AUTH?t=g&'>Google</a><a href='#AUTH?t=f&'>Facebook</a><a href='#AUTH?t=t&'>Twitter</a></div></div>";
			l=$(window).width()/2-250; t=window.scrollY+$(window).height()/2;
			$(aid).append($("<div id='<?=$id?>overlay' />").css({position:'absolute',top:0,left:0,height:$('body').height()+'px',width:$(window).width()+'px',background: '#333', opacity: 0.8}));
			$(aid).append($(login.replace(/\#AUTH/g,'/auth/').replace('&','&r='+window.location.href)).css({ position: 'absolute', left: l+'px', top: t+'px', background: '#000', color: '#fff' }));
			$(window).keydown(function(e) { if (e.which==27) { $('#<?=$id?>login').remove(); $('#<?=$id?>overlay').remove(); } });
			$('#a<?=$id?>close').click(function(e) { $('#<?=$id?>login').remove(); $('#<?=$id?>overlay').remove(); });
			$('.a<?=$id?>modal').addClass('flash');
			return false;

		},
		commented: function(r) {
			if (r=='{"noauth":1}') {
				athuga.doLogin();
				return false;
			}
			$.ajax( { url: 'rest/comments', success: athuga.comments, error: athuga.error, type: 'get',dataType:'json' } );
		},
		hook: function(id) {
			id=id?id:qid;
			$(qid).submit(function() {
				data= { c:$(qid).children()[0].value };
				if (pid=$(qid).attr('data-id')) data.ownComments={type:'comments',id:pid};
				$.ajax({ url: 'rest/comments', type: 'post', data: data, success: athuga.commented, error: athuga.error });
				return false;
			}); 
			$(qid).children()[0]?$(qid).children()[0].focus():null;
		}
		
	}

	ab=athuga;
	document.write(athuga.styleSheetCode+athuga.loginCode+"<div id='athuga_"+id+"'>"+athuga.commentCode+"</div>");
	$(document).ready(function() {
		$.ajax( { url: 'rest/comments', success: athuga.comments, error: athuga.error, type: 'get',dataType:'json' } );
	});

}();
