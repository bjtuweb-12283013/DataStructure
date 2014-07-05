#include <stdio.h>

typedef struct 
{
	int data;
	struct LNode *next;
}LNode, *LinkList;

LinkList CreateLinkList(int n)
{
	LinkList l, p, s;
	l = (LinkList)malloc(sizeof(LNode));
	if (!l)
    {
        printf("MALLOC ERROR\n");
        exit(1);
    }
	p = l;
	int i;
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

LinkList Reverse(LinkList l)
{	
	LinkList p, q;
	p = l->next;
	while (p->next != NULL)
	{
		q = p->next;
		if (q->next == NULL)
		{
			p->next = NULL;
			break;
		}
		p->next = q->next;
		q->next = l->next;
		l->next = q;
		//PrintLinkList(l);
	}
	q->next = l->next;
	l->next = q;
	return l;
}

void PrintLinkList(LinkList l)
{
	LinkList p;
	p = l->next;
	while (p->next != NULL)
	{
		printf("%d ", p->data);
		p = p->next;
	}
	printf("%d\n", p->data);
}

int main()
{
	LinkList l;
	int n;
	printf("input the number of LinkList: \n");
	scanf("%d", &n);
	l = CreateLinkList(n);
	printf("The origin list is:\n");
	PrintLinkList(l);

	printf("----------start Reverse---------\n");
	l = Reverse(l);
	printf("After Reverse the list is: \n");
	PrintLinkList(l);
	return 0;
}