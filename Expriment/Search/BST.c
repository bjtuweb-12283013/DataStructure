#include <stdio.h>
#define MAX_SIZE 100

typedef struct BiTNode
{
	int data;
	struct BiTNode *lchild, *rchild;
}BiTNode, *BiTree;

int SearchBST(BiTree T, int key, BiTree f, BiTree *p)
{
	if (!T)
	{
		*p = f;
		return 0;
	}
	else if (key==T->data)
	{
		*p = T;
		return 1;
	}
	else if (key<T->data)
		return SearchBST(T->lchild, key, T, p);
	else 
		return SearchBST(T->rchild, key, T, p);
}

int InsertBST(BiTree *T, int key)
{
	BiTree p, s;
	if (!SearchBST(*T, key, NULL, &p))
	{
		s = (BiTree)malloc(sizeof(BiTNode));
		s->data = key;
		s->lchild = s->rchild = NULL;
		if (!p)
			*T = s;
		else if (key<p->data)
			p->lchild = s;
		else
			p->rchild = s;
		return 1;
	}
	else 
		return 0;
}

int Delete(BiTree *p)
{
	BiTree q,s;
	if((*p)->rchild==NULL) 
	{
		q=*p;
		*p=(*p)->lchild; 
		free(q);
	}
	else if((*p)->lchild==NULL) 
	{
		q=*p; 
		*p=(*p)->rchild; 
		free(q);
	}
	else 
	{
		q=*p; 
		s=(*p)->lchild;
		while(s->rchild) 
		{
			q=s;
			s=s->rchild;
		}
		(*p)->data=s->data; 
		if(q!=*p) 
		q->rchild=s->lchild;
		else
		q->lchild=s->lchild;
		free(s);
	}
	return 1;
}

int DeleteBST(BiTree *T,int key)
{ 
	if(!*T) 
	return 0;
	else
	{
		if (key==(*T)->data)
			return Delete(T);
		else if (key<(*T)->data)
			return DeleteBST(&(*T)->lchild,key);
		else
			return DeleteBST(&(*T)->rchild,key);
	}
}

void InOrderTraverse(BiTree T)
{
	if (T)
	{
		InOrderTraverse(T->lchild);
		printf("%d ", T->data);
		InOrderTraverse(T->rchild);
	}
}

int main()
{
	int i, n, a[MAX_SIZE];
	int del;
	BiTree T = NULL;
	printf("Input number:\n");
	scanf("%d", &n);
	for (i=0;i<n;i++)
		scanf("%d", &a[i]);
	for (i=0;i<n;i++)
	{
		InsertBST(&T, a[i]);	
	}
	printf("Before Delete, InOrderTraverse: ");
	InOrderTraverse(T);
	printf("\n");

	printf("Input the KEY you want to Delete:");
	scanf("%d", &del);
	if (!DeleteBST(&T, del))
		printf("Not Exist\n");
	else
	{
		printf("After Delete %d, InOrderTraverse: ", del);
		InOrderTraverse(T);
		printf("\n");
	}
	return 0;
}










