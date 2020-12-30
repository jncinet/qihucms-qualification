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
### 所有可开通的功能
+ 请求方式：GET
+ 请求地址：role/roles
+ 请求参数：
```
{
    "name": "名称", // 可选
    "slug": "标识", // 可选
    "currency_type_id": 1, // 支付货币类型 可选
    "times": 1, // 有效时长 可选
    "unit": "days", // 有效时长单位 可选
    "is_pa": 1, // 是否需要完成个人认证 可选
    "is_co": 0, // 是否需要完成企业认证 可选
}
```
+ 返回值：
```
{
    "data": [
        {
            'id': 1,
            'name': "名称",
            'slug': "标识",
            'desc': "介绍",
            'times': 3,
            'unit': "days",
            'is_qualification_pa': 0,
            'is_qualification_co': 1,
            'price': 1.00,
            'currency_type': {货币详细信息},
        },
        ...
    ],
    "meta": {},
    "links": {},
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
| contacts          | varchar   |           |           |           | 联系人    |
| mobile            | varchar   |           |           |           | 手机号    |
| email             | varchar   |           | Y         | NULL      | 邮箱      |
| address           | varchar   |           | Y         | NULL      | 地址      |
| status            | tinyint   |           |           | 0         | 状态      |
| created_at        | timestamp |           | Y         | NULL      | 创建时间   |
| updated_at        | timestamp |           | Y         | NULL      | 更新时间   |
