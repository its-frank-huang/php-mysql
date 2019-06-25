<template>
	<div class="container" id="login-wrapper">
		<div class="card">
			<form @submit.prevent="submitLoginForm" class="card-content">
				<span class="card-title">登录</span>
				<div class="input-field">
					<input id="unameInput" type="text" class="validate" v-model="current.userName">
					<label>用户名</label>
					<span class="helper-text" id="unameSpan"></span>
				</div>
				<div class="input-field">
					<input id="upassInput" type="password" class="validate" v-model="current.userPass">
					<label>密码</label>
					<span class="helper-text" id="upassSpan"></span>
				</div>
				<label>
					<button class="btn waves-effect waves-light" type="submit">提交</button>
				</label>
			</form>
		</div>
	</div>
</template>
<script>
export default {
	mounted() {},
	data() {
		return {
			current: {}
		};
	},
	methods: {
		submitLoginForm() {
			let uName = this.current.userName;
			let uPass = this.current.userPass;
			let unameInputClass = document.getElementById("unameInput").classList;
			let upassInputClass = document.getElementById("upassInput").classList;
			let unameSpan = document.getElementById("unameSpan");
			let upassSpan = document.getElementById("upassSpan");

			if (uName && uPass) {
				if (uName !== "terry" || uPass !== "3943") {
					unameInputClass.add("invalid");
					upassInputClass.add("invalid");
					unameInputClass.remove("valid");
					upassInputClass.remove("valid");
					unameSpan.setAttribute("data-error", "错误");
					upassSpan.setAttribute("data-error", "错误");
					return;
				}
				unameSpan.setAttribute("data-success", "正确");
				upassSpan.setAttribute("data-success", "正确");
				unameInputClass.add("valid");
				upassInputClass.add("valid");
				unameInputClass.remove("invalid");
				upassInputClass.remove("invalid");

				window.localStorage.setItem("Kingkid", true);
				window.location.href = "/";
			} else {
				unameSpan.setAttribute("data-error", "此项不能为空");
				upassSpan.setAttribute("data-error", "此项不能为空");

				unameInputClass.add("invalid");
				upassInputClass.add("invalid");
				unameInputClass.remove("valid");
				upassInputClass.remove("valid");

				return;
			}
		}
	}
};
</script>
<style>
#login-wrapper {
    width: 30em;
    margin-top: 5rem;
}
</style>
