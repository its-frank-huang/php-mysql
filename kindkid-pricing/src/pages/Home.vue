<template>
	<div class="container row">
		<div class="col s6 list-wrapper">
			<nav id="search-nav">
				<div class="nav-wrapper teal lighten-2" id="search-form">
					<form>
						<div class="input-field">
							<input id="search" type="search" autocomplete="off" required>
							<label class="label-icon" for="search">
								<!-- <i class="material-icons" id="search-icon">search</i> -->
								<i class="iconfont material-icons" id="search-icon">&#xe873;</i>
							</label>
							<!-- <i class="material-icons" id="close-icon">close</i> -->
							<i class="iconfont material-icons" id="close-icon">&#xe600;</i>
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
				<div class="col s4 add-wrapper right" style="text-align:right;">
					<router-link to="/add" class="btn waves-effect waves-light teal lighten-2">添加产品</router-link>
				</div>
			</div>
			<ul class="list">
				<li class="list-item" :key="item.id" v-for="item in list">
					<div class="item-wrap valign-wrapper">
						<div>
							<img v-if="item.img" style="padding-right:.5em;" :src="'img/'+item.img">
							<span v-else>无图片</span>
						</div>
						<div>
							<span class="badge new teal lighten-2" data-badge-caption>{{item.id}}</span>
							<span class="item-title" :title="item.name">
								{{
								item.name.length > 10?
								item.name.substr(0,6) + "...":
								item.name
								}}
							</span>
							<div>
								<span>价格: {{item.cprice}}￥</span>
								<span>件数: {{item.camount}}件</span>
							</div>
							<div>
								<span>{{item.time}}</span>
							</div>
						</div>
						<div>
							<i v-if="!item.lprice || item.cprice == item.lprice" class="iconfont trend-icon black-text">-</i>
							<i v-else-if="item.cprice<item.lprice" class="iconfont trend-icon green-text">&#xe72d;</i>
							<i v-else-if="item.cprice>item.lprice" class="iconfont trend-icon">&#xe611;</i>
						</div>
					</div>
					<button class="btn waves-effect waves-light red iconfont" @click="removeItem(item)">&#xe6ac;</button>
				</li>
			</ul>
		</div>
		<div class="col s6 detail-wrapper">
			<router-view @refresh="addRefresh"></router-view>
		</div>
		<div id="modal" class="modal">
			<div class="modal-content"></div>
			<div class="modal-footer">
				<a @click="itemRemove = true"
					class="btn left modal-close red waves-effect waves-light"
				>确定</a>
				<a class="btn modal-close teal waves-effect waves-light">取消</a>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	data() {
		return {
			// list: [{"id":"21","name":"\u8fde\u8863\u88d9\u80cc\u5305\u9879\u94fe\u88e4\u5b50\u8863\u670d\u889c\u5b50\u62d6\u978b\u53ef\u601c","cprice":"200","camount":"1020","price_list":"[200]","amount_list":"[1020]","img":"21.png","lprice":null,"lamount":null,"color":"\u7ea2\u8272","time":"2019-06-30 12:53:49"},{"id":"20","name":"\u80cc\u5fc3","cprice":"200","camount":"1200","price_list":"[200]","amount_list":"[1200]","img":"20.png","lprice":null,"lamount":null,"color":"\u767d\u8272","time":"2019-06-30 12:48:58"},{"id":"19","name":"\u80cc\u5305","cprice":"200","camount":"120","price_list":"[200]","amount_list":"[120]","img":null,"lprice":null,"lamount":null,"color":"\u9ed1\u8272","time":"2019-06-30 12:36:02"},{"id":"18","name":"\u8fde\u8863\u88d9","cprice":"222","camount":"113","price_list":"[222]","amount_list":"[113]","img":null,"lprice":null,"lamount":null,"color":null,"time":"2019-06-28 23:59:13"},{"id":"16","name":"\u8fde\u8863\u88d9\u80cc\u5305\u9879\u94fe\u88e4\u5b50\u8863\u670d\u889c\u5b50\u62d6\u978b\u53ef\u601c","cprice":"77","camount":"25","price_list":"[77]","amount_list":"[25]","img":null,"lprice":null,"lamount":null,"color":null,"time":"2019-06-28 18:02:04"},{"id":"15","name":"\u80cc\u5305","cprice":"100","camount":"20","price_list":"[100]","amount_list":"[20]","img":null,"lprice":null,"lamount":null,"color":"\u9ed1\u8272","time":"2019-06-28 15:31:56"},{"id":"1","name":"\u80cc\u5305","cprice":"100","camount":"20","price_list":null,"amount_list":null,"img":null,"lprice":null,"lamount":null,"color":null,"time":"2019-06-28 15:25:08"},{"id":"14","name":"\u80cc\u5305","cprice":"100","camount":"20","price_list":"[100]","amount_list":"[20]","img":null,"lprice":null,"lamount":null,"color":"\u9ed1\u8272","time":"2019-06-28 15:25:08"},{"id":"13","name":"\u80cc\u5305","cprice":"100","camount":"20","price_list":null,"amount_list":null,"img":null,"lprice":null,"lamount":null,"color":"\u9ed1\u8272","time":"2019-06-28 15:25:08"}],
			list: [],
			itemRemove: false
		};
	},
	mounted() {
		this.read();
	},
	methods: {
		addRefresh() {
			this.read();
			window.location.href = "/#/add";
		},
		read() {
			fetch("php/product.php?action=read")
				.then(re => re.json())
				.then(data => {
					this.list = data;
				});
		},
		trendIcon(item) {
			if (!item.lprice || item.cprice == item.lprice) {
				return "<i class='iconfont trend-icon'>-</i>";
			} else if (item.cprice > item.lprice) {
				return "<i class='iconfont trend-icon'>&#xe611;</i>";
			} else {
				return "<i class='iconfont trend-icon'>&#xe72d;</i>";
			}
		},
		removeItem(item) {
			let modalEL = document.getElementById("modal");
			let mContentEL = document.querySelector("#modal .modal-content");
			let me = this;
			let modalIns = M.Modal.init(modalEL, {
				onCloseEnd() {
					if (me.itemRemove) {
						let body = new FormData();
						body.append("action", "remove");
						body.append("data", `id:${item.id}`);

						let fetchData = {
							method: "POST",
							body
						};
						fetch("php/product.php", fetchData)
							.then(e => {
								me.read();
								me.itemRemove = false;
							})
							.catch();
					}
					modalIns.destroy();
				}
			});
			mContentEL.innerHTML = `<h3 class="red-text" style="margin:0">删除产品</h3>
			<h5 class="red-text" style="margin:0">确定删除产品？</h5>
			<p style="margin:0">名称：${item.name}
			Id: ${item.id}
			价格：${item.cprice}
			件数：${item.camount}
			颜色：${item.color || "无"}</p>`;
			modalIns.open();
		}
	}
};
</script>
<style>
ul.list li.list-item button.btn {
	height: 100%;
	padding: 0;
	border-radius: 0;
	text-align: center;
	box-shadow: none;
}
ul.list li.list-item button.btn:hover {
	box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14),
		0 3px 1px -2px rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);
}
ul.list li.list-item .item-wrap {
	padding: 0.5em;
	display: grid;
	grid-template-columns: 2fr 8fr 1fr;
}
ul.list li.list-item {
	border: 1px solid #ccc;
	display: grid;
	grid-template-columns: 11fr 1fr;
	padding: 0;
	/* border-radius: 5px; */
	overflow: hidden;
	border-bottom-width: 0;
	border-top: 1px #eee solid;
}
ul.list li.list-item:first-of-type {
	border-top: 1px #ccc solid;
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
}
ul.list li.list-item:last-of-type {
	border-bottom-width: 1px;
	border-bottom-left-radius: 5px;
	border-bottom-right-radius: 5px;
}
ul.list li.list-item .badge {
	float: left;
	margin-left: 0;
	min-width: 1.5em;
	margin-right: 0.5em;
}
.item-title {
	font-size: 1.1em;
	font-weight: bold;
}
i.trend-icon {
	font-size: 1.3em;
	color: orangered;
}
i#search-icon {
	/* cursor: pointer; */
	line-height: 2em;
	height: 2em;
}
i#close-icon {
	line-height: 2.4em;
	height: 1.5em;
	font-size: 1.2em;
}
nav#search-nav {
	height: 3em;
}
nav#search-nav label.active i {
	cursor: pointer;
}
input#search {
	border: 0;
}
.collection-item span.badge.new {
	font-size: 1em;
	font-family: Roboto;
}
</style>
