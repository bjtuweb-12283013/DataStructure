#include <stdio.h>
#define INIT_LIST_SIZE 100
#define LIST_INCREMENT 10
typedef struct{
    char name[20];
    char number[20];
    char job[20];
}Worker;

typedef struct{
    Worker *elem;
    int length;
    int listsize;
}SQlist;

SQlist InitList(int n)
{
    SQlist l;
    l.elem = (Worker *)malloc(INIT_LIST_SIZE*sizeof(Worker));   //malloc前写 SQlist * 也行  为什么？
    if (!l.elem)
        exit(1);
    int i;
    char name[20], number[20], job[20];
    Worker worker;

    for (i=0;i<n;i++)
    {
        printf("请依次输入第%d个员工的姓名，工号，职务：\n", i+1);
        scanf("%s", name);
        scanf("%s", number);
        scanf("%s", job);
        strcpy(worker.name, name);
        strcpy(worker.number, number);
        strcpy(worker.job, job);
        l.elem[i] = worker;
    }
    l.length = n;
    l.listsize = INIT_LIST_SIZE;
    printf("######初始化成功######\n");
    return l;
}

void printlist(SQlist l)
{
    int i;
    Worker worker;
    for (i=0;i<l.length;i++)
    {
        worker = l.elem[i];
        printf("第%d个员工的信息：\n", i+1);
        printf("姓名: %s\n", worker.name);
        printf("工号: %s\n", worker.number);
        printf("职务: %s\n", worker.job);
        printf("\n");
    }
}

SQlist insertlist(SQlist l, Worker worker, int i)
{
    Worker *q, *p;
    if (i<1 || i>l.length+1)
    {
        printf("insert:the error i\n");
        exit(1);
    }
    q = &(l.elem[i-1]);
    for (p=&(l.elem[l.length-1]);p>=q;p--)
        *(p+1) = *p;
    *q = worker;
    l.length++;
    printf("######插入新员工成功######\n");
    return l;
}

SQlist deletelist(SQlist l, int i)
{
    Worker *p, *q;
    if (i<1 || i>l.length)
    {
        printf("insert:the error i\n");
        exit(1);
    }
    p = &(l.elem[i-1]);
    q = &(l.elem[l.length-1]);
    for (++p;p<=q;++p)
        *(p-1) = *p;
    l.length--;
    printf("######删除离职员工成功######\n");
    return l;
}

Worker addnewworker()
{
    Worker worker;
    char name[20], number[20], job[20];
    printf("请依次输入新入职员工的姓名，工号，职务:\n");
    scanf("%s", name);
    scanf("%s", number);
    scanf("%s", job);
    strcpy(worker.name, name);
    strcpy(worker.number, number);
    strcpy(worker.job, job);
    return worker;
}

SQlist INIT(SQlist l)
{
    int n;
    printf("-----------------------------\n");
    printf("*********初始化员工**********\n");
    printf("-----------------------------\n");
    printf("请输入初始化员工的人数： ");
    scanf("%d", &n);
    l = InitList(n);
    printlist(l);
    return l;
}

SQlist ADD(SQlist l)
{
    printf("-----------------------------\n");
    printf("*********入职新员工**********\n");
    printf("-----------------------------\n");
    Worker worker;
    worker = addnewworker();
    int i;
    printf("请输入该新员工插入顺序表的位置: \n");
    scanf("%d", &i);
    l = insertlist(l, worker, i);
    printlist(l);
    return l;
}

SQlist DELETE(SQlist l)
{
    printf("-----------------------------\n");
    printf("**********员工离职**********\n");
    printf("-----------------------------\n");
    printf("请输入要删除的员工的位置:\n");
    int i;
    scanf("%d", &i);
    l = deletelist(l, i);
    printlist(l);
    return l;
}

void showmenu()
{
    SQlist l;
    printf("##########################################################\n");
    printf("------------------------员工信息系统----------------------\n");
    printf("##########################################################\n");
    printf("第一次使用前请先初始化员工顺序表\n");
    l = INIT(l);

    int select;
    while (1)
    {
        printf("请选择操作：\n");
        printf("1、增加新入职员工\n");
        printf("2、删除离职员工\n");
        printf("0、退出\n");
        scanf("%d", &select);
        switch(select)
        {
            case 1:l = ADD(l);break;
            case 2:l = DELETE(l);break;
            case 0:exit(1);break;
            default:printf("输入有误---\n");
        }
    }
}

void main()
{
    showmenu();
}






































