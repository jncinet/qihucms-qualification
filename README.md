<h1 align="center">认证管理</h1>

## 安装

```shell
$ composer require jncinet/qihucms-qualification
```

## 使用

### 数据迁移
```shell
$ php artisan migrate
```

### 发布资源
```shell
$ php artisan vendor:publish --provider="Qihucms\Qualification\QualificationServiceProvider"
```

## 后台菜单
+ 个人认证 `qualification/pas`
+ 企业认证 `qualification/cos`

## 接口
### 个人认证
+ 请求方式：POST
+ 请求地址：qualification/pas
+ 请求参数：
```
{
    "real_name": "张三",
    "id_card_no": "4324324324",
    "files": ['图片地址1','图片地址2'],
}
```
+ 返回值：
```
{
    "user_id": 1,
    "real_name": "张三",
    "id_card_no": "3424324234",
    "files": ['图片地址1','图片地址2'],
    "status": 1,
    "created_at": "2分钟前",
    "updated_at": "1分钟前",
}
```

### 个人认证查询
+ 请求方式：GET
+ 请求地址：qualification/pas
+ 返回值：
```
{
    "user_id": 1,
    "real_name": "张三",
    "id_card_no": "3424324234",
    "files": ['图片地址1','图片地址2'],
    "status": 1,
    "created_at": "2分钟前",
    "updated_at": "1分钟前",
}
```

### 企业认证
+ 请求方式：POST
+ 请求地址：qualification/cos
+ 请求参数：
```
{
    "company_name": "**公司",
    "company_id": "342432324234",
    "files": ['图片地址1','图片地址2'],
    "mobile": "手机号",
    "email": "邮箱",
    "address": "地址",
}
```
+ 返回值：
```
{
    "user_id": 1,
    "company_name": "**公司",
    "company_id": "342432324234",
    "files": ['图片地址1','图片地址2'],
    "mobile": "手机号",
    "email": "邮箱",
    "address": "地址",
    "status": 1,
    "created_at": "2分钟前",
    "updated_at": "1分钟前",
}
```

### 企业认证查询
+ 请求方式：GET
+ 请求地址：qualification/cos
+ 返回值：
```
{
    "user_id": 1,
    "company_name": "**公司",
    "company_id": "342432324234",
    "files": ['图片地址1','图片地址2'],
    "mobile": "手机号",
    "email": "邮箱",
    "address": "地址",
    "status": 1,
    "created_at": "2分钟前",
    "updated_at": "1分钟前",
}
```

## 数据库
### 个人认证记录表：qualification_pas
| Field             | Type      | Length    | AllowNull | Default   | Comment   |
| :----             | :----     | :----     | :----     | :----     | :----     |
| id                | bigint    |           |           |           |           |
| user_id           | bigint    |           |           |           | 会员ID     |
| real_name         | varchar   | 255       |           |           | 真实姓名   |
| id_card_no        | varchar   | 255       |           |           | 身份证号   |
| files             | json      |           | Y         | NULL      | 证明文件   |
| status            | tinyint   |           |           | 0         | 状态      |
| created_at        | timestamp |           | Y         | NULL      | 创建时间   |
| updated_at        | timestamp |           | Y         | NULL      | 更新时间   |

### 企业认证记录表：qualification_cos
| Field             | Type      | Length    | AllowNull | Default   | Comment   |
| :----             | :----     | :----     | :----     | :----     | :----     |
| id                | bigint    |           |           |           |           |
| user_id           | bigint    |           |           |           | 会员ID     |
| company_name      | varchar   | 255       |           |           | 公司名称   |
| company_id        | varchar   | 255       |           |           | 统一信用代码 |
| files             | json      |           | Y         | NULL      | 证明文件   |
| contacts          | varchar   | 255       |           |           | 联系人    |
| mobile            | varchar   | 255       |           |           | 手机号    |
| email             | varchar   | 255       | Y         | NULL      | 邮箱      |
| address           | varchar   | 255       | Y         | NULL      | 地址      |
| status            | tinyint   |           |           | 0         | 状态      |
| created_at        | timestamp |           | Y         | NULL      | 创建时间   |
| updated_at        | timestamp |           | Y         | NULL      | 更新时间   |
