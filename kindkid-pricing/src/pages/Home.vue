<template>
	<div class="container row">
		<div class="col s6 list-wrapper">
			<nav id="search-nav">
				<div class="nav-wrapper teal lighten-2" id="search-form">
					<form>
						<div class="input-field">
							<input id="search" type="search" required>
							<label class="label-icon" for="search">
								<i class="material-icons" id="search-icon">search</i>
							</label>
							<i class="material-icons" id="close-icon">close</i>
						</div>
					</form>
				</div>
			</nav>
			<div class="row valign-wrapper">
				<div class="col cat-wrapper">
					<label style="margin-right:.5em;">
						<input name="cat" type="radio" checked>
						<span>男装</span>
					</label>
					<label>
						<input name="cat" type="radio">
						<span>女装</span>
					</label>
				</div>
				<div class="col s4 add-wrapper right"  style="text-align:right;">
					<router-link to="/add" class="btn waves-effect waves-light teal lighten-2">添加产品</router-link>
				</div>
			</div>
			<ul class="collection">
				<li class="collection-item row valign-wrapper">
					<div class="col s2" style="margin-left:0;">
						<img src="../assets/cloth/cloth (1).png">
					</div>
					<div class="col s9">
						<div class="row" style="margin-bottom:.5em;">
							<span class="col badge new teal lighten-2" data-badge-caption="">1</span>
							<span class="col item-title" title="职业装女装2019春夏新款时尚正装工装西装套装商务休闲西服工作服">职业装女装2019</span>
						</div>
						<span>价格: 20￥</span>
						<span>件数: 20件</span>
					</div>
					<div class="col">
                        <i class="iconfont trend-icon">&#xe611;</i>
					</div>
				</li>
				<li class="collection-item row valign-wrapper">
					<div class="col s2" style="margin-left:0;">
						<img src="../assets/cloth/cloth (1).png">
					</div>
					<div class="col s9">
						<div class="row" style="margin-bottom:.5em;">
							<span class="col badge new teal lighten-2" data-badge-caption="">1</span>
							<span class="col item-title" title="职业装女装2019春夏新款时尚正装工装西装套装商务休闲西服工作服">职业装女装2019</span>
						</div>
						<span>价格: 20￥</span>
						<span>件数: 20件</span>
					</div>
					<div class="col">
                        <i class="iconfont trend-icon">&#xe611;</i>
					</div>
				</li>
				<li class="collection-item row valign-wrapper">
					<div class="col s2" style="margin-left:0;">
						<img src="../assets/cloth/cloth (1).png">
					</div>
					<div class="col s9">
						<div class="row" style="margin-bottom:.5em;">
							<span class="col badge new teal lighten-2" data-badge-caption="">1</span>
							<span class="col item-title" title="职业装女装2019春夏新款时尚正装工装西装套装商务休闲西服工作服">职业装女装2019</span>
						</div>
						<span>价格: 20￥</span>
						<span>件数: 20件</span>
					</div>
					<div class="col">
                        <i class="iconfont trend-icon">&#xe611;</i>
					</div>
				</li>
			</ul>
		</div>
		<div class="col s6 detail-wrapper">
            <router-view></router-view>
        </div>
	</div>
</template>
<script>
export default {};
</script>
<style>
.item-title{
    font-size: 1.1em;
    font-weight: bold;
}
i.trend-icon{
    font-size: 1.3em;
    color: orangered;
}
i#search-icon {
	line-height: 2em;
	height: 2em;
}
i#close-icon {
	line-height: 1.5em;
	height: 1.5em;
}
nav#search-nav {
	height: 3em;
}
input#search {
	border: 0;
}
.collection-item span.badge.new{
    font-size: 1em;
    font-family: Roboto;
}
</style>
