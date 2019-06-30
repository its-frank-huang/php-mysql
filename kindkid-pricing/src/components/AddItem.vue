<template>
	<div class="card" style="margin-top:0;">
		<i @click="addItemCancel" style="top:2px;right:5px;" class="iconfont cancel-icon">&#xe600;</i>
		<form class="card-content" @submit.prevent="addFormSubmit">
			<span style="text-align:center;" class="card-title">添加产品</span>
			<div class="input-field">
				<input type="text" v-model="current.name" id="cName" class="validate">
				<label>名称</label>
				<span class="helper-text" data-error="此为必填项" data-success="正确"></span>
			</div>
			<div class="row">
				<div class="col s6">
					<div class="drop-wrap">
						<div id="drop-zone" @dragleave="dragleave" @dragover="dragover" @drop="drop">拖放图片</div>
						<div id="img-preview">
							<i @click="imgCancel" class="iconfont cancel-icon">&#xe600;</i>
						</div>
					</div>
					<div class="file-input-wrap">
						<button type="button" class="btn waves-effect waves-light teal lighten-2">选择图片</button>
						<input type="file" @change="imgChange" class="validate" id="file-input">
					</div>
				</div>
				<div class="col s6">
					<div class="input-field">
						<input type="text" v-model="current.color" class="validate">
						<label>颜色</label>
						<span class="helper-text"></span>
					</div>
					<div class="input-field">
						<input type="number" id="cPrice" v-model="current.price" class="validate">
						<label>价格</label>
						<span class="helper-text" data-error="此为必填项" data-success="正确"></span>
					</div>
					<div class="input-field">
						<input type="number" id="cAmount" v-model="current.amount" class="validate">
						<label>件数</label>
						<span class="helper-text" data-error="此为必填项" data-success="正确"></span>
					</div>
				</div>
			</div>
			<button type="submit" class="btn waves-effect waves-light teal lighten-2">添加</button>
		</form>
		<div id="modal" class="modal">
			<div class="modal-content">
			</div>
			<div class="modal-footer">
				<a href="#!" class="modal-close waves-effect waves-teal btn-flat">返回</a>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	data() {
		return {
			current: {},
			cValid: true
		};
	},
	methods: {
		addFormSubmit() {
			let c = this.current;

			c.name
				? this.invaildInput("cName", true)
				: this.invaildInput("cName", false);
			c.price
				? this.invaildInput("cPrice", true)
				: this.invaildInput("cPrice", false);
			c.amount
				? this.invaildInput("cAmount", true)
				: this.invaildInput("cAmount", false);

			if (!this.cValid) return;

			let body = new FormData();

			body.append("data", JSON.stringify(this.current));
			body.append("action", "add");

			if (this.cImg) {
				body.append("img", this.cImg);
			}

			let fetchData = {
				method: "POST",
				body
			};
			fetch("php/product.php", fetchData)
				.then(e => {
					this.imgCancel();
					this.addItemCancel();
					this.$emit("refresh");
				})
				.catch();
		},
		invaildInput(input, valid) {
			let inEl = document.getElementById(input);
			let klass = inEl.classList;

			if (valid) {
				this.cValid = true;
				klass.add("valid");
				klass.remove("invalid");
			} else {
				this.cValid = false;
				klass.add("invalid");
				klass.remove("valid");
			}
		},
		dragover(e) {
			e.stopPropagation();
			e.preventDefault();
			e.target.classList.add("overEffect");
			e.dataTransfer.dropEffect = "copy";
		},
		dragleave(e) {
			e.stopPropagation();
			e.preventDefault();
			e.target.classList.remove("overEffect");
		},
		drop(e) {
			e.stopPropagation();
			e.preventDefault();
			e.target.classList.remove("overEffect");

			let img = e.dataTransfer.files[0];
			this.imgPreview(img);
		},
		imgError(type) {
			let modalEL = document.getElementById("modal");
			let mContentEL = document.querySelector("#modal .modal-content");
			let modalIns = M.Modal.init(modalEL, {
				onCloseEnd() {
					modalIns.destroy();
				}
			});
			let text = "";

			switch (type) {
				case 2001:
					text = "未检测到图片。\n Error: 1001";
					break;
				case 1001:
					text = "图片格式只能为'.jpg'或'.png'。\n Error: 1002";
					break;
				default:
					break;
			}
			mContentEL.innerHTML = `<h4>图片错误 img error</h4><p>${text}</p>`;
			modalIns.open();
		},
		imgCancel() {
			if (!this.cImg) return;
			let previewEl = document.getElementById("img-preview");
			let dropEl = document.getElementById("drop-zone");

			dropEl.hidden = false;
			previewEl.removeChild(previewEl.childNodes[1]);
		},
		addItemCancel() {
			let arr = ["cName", "cPrice", "cAmount"];
			arr.forEach(it => {
				let klass = document.getElementById(it).classList;

				klass.remove("valid");
				klass.remove("invalid");
			});

			this.current = {};
			window.location.href = "/#/";
		},
		imgPreview(img) {
			if (!img) {
				this.imgError(2001);
				return;
			}

			console.log(img.type);
			if (img.type == "image/jpeg" || img.type == "image/png") {
				let reader = new FileReader();

				reader.onload = e => {
					// Render thumbnail.
					let previewEl = document.getElementById("img-preview");
					let dropEl = document.getElementById("drop-zone");
					let imgEl = document.createElement("img");

					imgEl.src = e.target.result;
					previewEl.appendChild(imgEl);
					this.cImg = img;
					dropEl.hidden = true;
				};

				reader.readAsDataURL(img);
			} else {
				this.imgError(1001);
				return;
			}
		},
		imgChange(e) {
			let img = e.target.files[0];

			this.imgPreview(img);
		}
	}
};
</script>
<style>
#img-preview,
.card {
	position: relative;
}
i.cancel-icon {
	position: absolute;
	top: 0;
	right: 2px;
	cursor: pointer;
}
.overEffect {
	opacity: 0.5;
}
.file-input-wrap {
	position: relative;
}
#file-input {
	cursor: pointer;
	opacity: 0;
	top: 0;
	z-index: 10;
	height: 36px;
	width: 100%;
	position: absolute;
}
#drop-zone {
	padding: 5.6em 0;
	margin: 0.2em;
	border: 2px dashed teal;
	text-align: center;
}
</style>


