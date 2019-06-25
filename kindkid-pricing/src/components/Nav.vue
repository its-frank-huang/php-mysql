<template>
	<nav class="teal">
		<div class="nav-wrapper container row">
			<span :class="{'center':!login,'brand-logo white-text':true}">
				<img src="../assets/logo-white.svg" id="logo">
			</span>
			<ul id="nav-mobile" v-if="login" class="right">
				<li>
					<router-link class="white-text" to="/">产品列表</router-link>
				</li>
				<li>
					<router-link class="white-text" to="/overview">产品总览</router-link>
				</li>
				<li>
					<a class="white-text" @click="logout">登出</a>
				</li>
			</ul>
		</div>
	</nav>
</template>
<script>
export default {
	data() {
		return {
			login: false
		};
	},
	mounted() {
		this.loginCheck();
		setInterval(this.loginCheck, 1000);
	},
	methods: {
		loginCheck() {
			if (!JSON.parse(window.localStorage.getItem("Kingkid"))) {
				window.location.href = "/#/login";
				this.login = false;
				return;
			}
			this.login = true;
		},
		logout() {
			window.localStorage.setItem("Kingkid", false);
			this.login = false;
		}
	}
};
</script>
<style>
nav {
	margin-bottom: 2rem;
}
#logo {
	width: 25%;
	margin-top: 0.4em;
}
</style>

