#include <stdio.h>

typedef struct 
{
	int data;
	int freq;
	struct LNode *prior;
	struct LNode *next;
}LNode, *LinkList;

// Create a linklist with n node
LinkList CreateLinkList(int n)
{
	LinkList l, s, p;
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
		s->freq = 0;
		scanf("%d", &s->data);
		p->next = s;
		s->prior = p;
		p = p->next;
	}
	p->next = l;
	return l;
}

LinkList Locate(LinkList l, int x)
{
	int i;
	LinkList p = l->next;
	LinkList q;
	//the freq of node x +1
	for (i=0;i<x-1;i++)
		p = p->next;
	p->freq += 1;  

	//find the pos where the p should be insert
	q = l->next;
	while (q->freq > p->freq)
		q = q->next;

	//if the first node do the Locate()
	if (p==q)
		return l;

	//change prior and next of p
	LinkList mprior, mnext;
	mprior = p->prior;
	mnext = p->next;
	mprior->next = mnext;
	mnext->prior = mprior; 

	//insert p into the header of l
	mprior = q->prior;
	p->next = q;
	q->prior = p;
	mprior->next = p;
	p->prior = mprior;

	return l;
}

void PrintLinkList(LinkList l)
{
	LinkList p = l->next;
	while (p->next != l)
	{
		printf("data=%d freq=%d   ", p->data, p->freq);
		p = p->next;
	}
	printf("data=%d freq=%d\n", p->data, p->freq);
}

int main()
{
	
	LinkList l;
	int n;
	printf("Begin to Create the LinkList, input n:\n");
	scanf("%d", &n);
	printf("Input data for every node in order:\n");
	l = CreateLinkList(n);
	printf("The origin LinkList is: \n");
	PrintLinkList(l);
	printf("Input the position 'x' you want to Locate, end with -1\n");
	int x;
	scanf("%d", &x);
	while (x!=-1)
	{
		if (x<1 || x>n)
		{
			printf("INPUT ERROR! Please try to input again~\n");
			scanf("%d", &x);
			continue;
		}
		l = Locate(l, x);
		printf("###The new LinkList is:\n");
		PrintLinkList(l);
		printf("\nInput the position 'x' you want to Locate, end with -1\n");
		scanf("%d", &x);
	}
	return 0;
}