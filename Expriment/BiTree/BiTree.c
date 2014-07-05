#include <stdio.h>

typedef struct BiTNode{
	char data;
	struct BiTNode *lchild;
	struct BiTNode *rchild;
}BiTNode, *BiTree;

void CreateBiTree(BiTree *T)
{
	char ch;
	scanf("%c", &ch);
	if (ch == ' ')
		*T = NULL;
	else
	{
		*T = (BiTree)malloc(sizeof(BiTNode));
		if (!*T)
			exit(1);
		(*T)->data = ch;
		CreateBiTree(&(*T)->lchild);
		CreateBiTree(&(*T)->rchild);
	}
}

void PreOrderTraverse(BiTree T)
{
	if (T)
	{
		printf("%c ", T->data);
		PreOrderTraverse(T->lchild);
		PreOrderTraverse(T->rchild);
	}
}

void InOrderTraverse(BiTree T)
{
	if (T)
	{
		InOrderTraverse(T->lchild);
		printf("%c ", T->data);
		InOrderTraverse(T->rchild);
	}
}

void PostOrderTraverse(BiTree T)
{
	if (T)
	{
		PostOrderTraverse(T->lchild);
		PostOrderTraverse(T->rchild);
		printf("%c ", T->data);
	}
}

void InOrderStack(BiTree T)
{
	BiTree *stack[50], p;
	int top = 0;
	p = T;
	do
	{
		while (p!=NULL)
		{
			top++;
			stack[top] = p;
			p = p->lchild;
		}
		if (top>0)
		{
			p = stack[top];
			top--;
			printf("%c ",p->data);
			p = p->rchild;
		}
	}while (p!=NULL || top!=0);
}

void TransLevel(BiTree T)
{
	struct node
	{
		BiTree *vec[100];
		int f, r;
	}q;
	q.f = 0;
	q.r = 0;
	if (T!=NULL)
		printf("%c ", T->data);
	q.vec[q.r] = T;
	q.r = q.r + 1;
	while (q.f < q.r)
	{
		T = q.vec[q.f];
		q.f = q.f + 1;
		if (T->lchild!=NULL)
		{
			printf("%c ", T->lchild->data);
			q.vec[q.r] = T->lchild;
			q.r = q.r + 1;
		}
		if (T->rchild!=NULL)
		{
			printf("%c ",T->rchild->data);
			q.vec[q.r] = T->rchild;
			q.r = q.r + 1;
		}
	}
}

int Depth(BiTree T)
{
	if (!T)
		return 0;
	int depthLeft = Depth(T->lchild);
	int depthRight = Depth(T->rchild);
	return 1+(depthLeft>depthRight?depthLeft:depthRight);
}

typedef struct CSNode
{
	char data;
	struct CSNode *firstchild;
	struct CSNode *nextsibling;
}CSNode, *CSTree;

int TreeDepth(CSTree T)
{
	if (!T)
		return 0;
	int h1 = TreeDepth(T->firstchild);
	int h2 = TreeDepth(T->nextsibling);
	return (h1+1)>h2?h1:h2;
}

int main()
{
	BiTree T;
	printf("input the Extended sequence:\n");
	CreateBiTree(&T);
	printf("PreOrderTraverse: ");
	PreOrderTraverse(T);
	printf("\n");

	printf("InOrderTraverse: ");
	InOrderTraverse(T);
	printf("\n");

	printf("PostOrderTraverse: ");
	PostOrderTraverse(T);
	printf("\n");

	printf("InOrderStackTraverse: ");
	InOrderStack(T);
	printf("\n");

	printf("TransLevel: ");
	TransLevel(T);
	printf("\n");

	printf("Depth is : %d\n", Depth(T));
	return 0;
}














