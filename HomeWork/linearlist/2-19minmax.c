#include <stdio.h>

typedef struct{
    int data;
    struct LNode* next;
}LNode, *LinkList;

LinkList CreateLinkList(int n)
{
    printf("create---------\n");
    printf("input %d number increment: \n", n);
    LinkList l;
    LinkList p,s;
    int i;
    l = (LinkList)malloc(sizeof(LNode));
    if (!l)
    {
        printf("MALLOC ERROR\n");
        exit(1);
    }
    p = l;
    for (i=0;i<n;i++)
    {
        s = (LinkList)malloc(sizeof(LNode));
        scanf("%d", &s->data);
        p->next = s;
        p = p->next;
    }
    p->next = NULL;
    return l;
}

void PrintLinkList(LinkList l)
{
    LinkList p;
    p = l->next;
    while (p)
    {
        printf("%d ", p->data);
        p = p->next;
    }
    if (l->next == NULL)
        printf("NULL\n");
    printf("\n");
}

LinkList DeleteLinkList(LinkList l, int mink, int maxk)
{
    LinkList p, q;
    p = l;
    q = p->next;
    while (q->data <= mink)
    {
        p = p->next;
        q = p->next;
    }
    while(q->data>mink && q->data<maxk)
    {
        if (q->next == NULL)
        {
            p->next = NULL;
            break;
        }
        p->next = q->next;
        free(q);
        q = p->next;
    }
    return l;
}

int main()
{
    int n;
    printf("input n\n");
    scanf("%d", &n);
    LinkList l;
    l = CreateLinkList(n);
    printf("The original increasing sequence: ");
    PrintLinkList(l);

    int mink, maxk;
    printf("input mink, maxk\n");
    scanf("%d%d", &mink, &maxk);
    l = DeleteLinkList(l, mink, maxk);
    printf("The deleted increasing sequence: ");
    PrintLinkList(l);
    return 0;
}
