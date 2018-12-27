<!-- 底部按钮 -->
<?php if(isset($menu)): ?>
<div class="nav-footer">
	<ul>
		<li class="text-center float-left width50">
			<div class="aclick-btn footer-item inline-block <?php if($menu === 'homepage'): ?>active<?php endif; ?>" data-url="et.redirect(et.url('home/index/index'));">
				<i class="cf-icon-home"></i>
				<div class="footer-item-text">首页</div>
			</div>
		</li>
		<li class="text-center float-left width50">
			<div class="aclick-btn footer-item inline-block <?php if($menu === 'mepage'): ?>active<?php endif; ?>" data-url="et.redirect(et.url('user/me/index'));">
				<i class="cf-icon-me"></i>
				<div class="footer-item-text">我的</div>
			</div>
		</li>
	</ul>
</div>
<?php endif; ?>