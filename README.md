RBAC
====

传统rbac 管理 node-role-access.

作用于dispatch 实现权限控制.

附:
本人实际项目中已将此结构略有改进,可参考:
<ul>
    <li>[table]access[role_id,menu] menu 存储 node list,登录初始化进内存</li>
    <li>简化逻辑处理，层级只体现在[table]role中</li>
    <li>[table] node add field [show]  针对不同 role 菜单可控显示.</li>
</ul>


