#include <stdio.h>

typedef struct{
    int num;
    int pwd;
}Person;

typedef struct {
    Person person;
    struct LNode *next;
}LNode, *LinkList;

LinkList CreateLinkList(int n)
{
    LinkList l = (LinkList)malloc(sizeof(LNode));
    LinkList p, tail;
    tail = l;
    int i;
    Person mperson;
    for (i=0;i<n;i++)
    {
        p = (LinkList)malloc(sizeof(LNode));
        mperson.num = i+1;
        printf("input pwd of person %d\n", i+1);
        scanf("%d", &mperson.pwd);
        p->person = mperson;
        tail->next = p;
        tail = p;
    }
    tail->next = l->next;
//    printf("%d", p->next->next->data);
    return l;
}

LinkList DeleteLinkList(LinkList l, int i)
{
    LinkList p = l;
    LinkList q;
    int j;
    for (j=0;j<i-1;j++)
        p = p->next;
    q = p->next;
    p->next = q->next;
    free(q);
    return l;
}

void PrintLinkList(LinkList l)
{
    printf("-------start print---------\n");
    int i;
    LinkList p = l->next;
    while (p->next != l->next)
    {
        printf("%d %d\n", (p->person).num, (p->person).pwd);
        p = p->next;
    }
}

int GetIOfPwd(LinkList l, int pwd)
{
    int i = 1;
    LinkList p = l->next;
    while (p->next != l->next)
    {
        if (pwd==(p->person).pwd)
            return i;
        p = p->next;
        i++;
    }
}

void StartGame(LinkList l, int n, int m)
{
    printf("out order:  ");
    int i;
    LinkList p = l->next;
    LinkList q;
    while (n--)
    {
        for (i=0;i<m-2;i++)
            p = p->next;
        q = p->next;
        m = (q->person).pwd;
        printf("%d ", (q->person).num, (q->person).pwd);
        p->next = q->next;
        p = q->next;
        free(q);
      //  PrintLinkList(l);
    }
    printf("\n");
}

int main()
{
    LinkList l;
    printf("input number of person\n");
    int n, m;
    scanf("%d", &n);
    printf("input m\n");
    scanf("%d", &m);
    l = CreateLinkList(n);
    StartGame(l, n, m);
}
