## todoList

### 介绍

> 一个简单todoList小练习,没做工程化,也没做太严格的验证

### 使用技术栈

#### 前端

> Vue + Bootstrap + axios

#### 后端 

> PHP + MySQL

#### 目录结构

    ├── css
    │   ├── index.css        // 项目css文件
    │   │
    ├── Data                 // 后端配置
    │   │
    │   ├── addMes.php       // 添加数据
    │   ├── queryMes.php     // 返回数据
    │   ├── editMes.php      // 修改数据
    │   ├── delMes.php       // 删除数据  
    │   │
    ├── lib                  // 用到的公用资源
    │   ├── axios.min.js     // axios
    │   ├── vue.min.js       // vue
    │   │
    ├── README.md
    ├── todolist.html

#### 表结构

```sql
CREATE TABLE `todo` (
  `todoId` int(11) NOT NULL AUTO_INCREMENT,
  `todoText` text,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`todoId`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
```