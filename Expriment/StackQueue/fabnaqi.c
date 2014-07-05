#include <stdio.h>
#define MAXSIZE 4

typedef struct 
{
	int elem[MAXSIZE];
	int front;
	int rear;
}Queue;

int n = 3;

Queue InitQueue()
{
	Queue q;
	int i;
	for (i=0;i<3;i++)
		q.elem[i] = 0;
	q.elem[3] = 1;
	q.front = 0;
	q.rear = 3;
	return q;
}

Queue EnQueue(Queue q, int e)
{
	q.rear = (q.rear+1) % MAXSIZE;
	q.elem[q.rear] = e;
	n++;
	return q;
}

Queue DeQueue(Queue q)
{
	q.front = (q.front+1) % MAXSIZE;
	return q;
}

int getSum(Queue q)
{
	int i;
	int sum = 0;
	for (i=0;i<MAXSIZE;i++)
		sum += q.elem[i];
	return sum;
}

void PrintQueue(Queue q)
{
	printf("f(%2d)=%3d    The Queue is   ",n, q.elem[q.rear]);
	int p;
	for (p=q.front;p!=q.rear;p=(p+1)%MAXSIZE)
		printf("%d ", q.elem[p]);
	printf("%d", q.elem[q.rear]);
	printf("\n");
}

int main()
{
	Queue q;
	q = InitQueue();
	while (q.elem[q.rear]<200)
	{
		q = DeQueue(q);
		q = EnQueue(q, getSum(q));
		PrintQueue(q);	
	}
	printf("\nIF f(n)<=200 && f(n+1)>200, THEN the appropriate n == %d\n", n-1);
	return 0;
}















































/*
#include <stdio.h>
#define MAXSIZE 4

int n = 1;

typedef struct 
{
	int elem[MAXSIZE];
	int front;
	int rear;
}Queue;

Queue InitQueue()
{
	Queue q;
	int i;
	for (i=0;i<3;i++)
		q.elem[i] = 0;
	q.elem[3] = 1;
	q.front = 0;
	q.rear = 3;
	return q;
}

void PrintQueue(Queue q)
{
	
	int i;
	printf("when n =%d, f(%d)=%d   The queue is: ", n, n, q.elem[q.front]);
	for (i=0;i<MAXSIZE;i++)
		printf("%d ", q.elem[i]);
	printf("\n");
}

Queue Fab(Queue q)
{
	int i;
	for (i=0;i<30;i++)
	{
		q.elem[q.front] = getSum(q);
		q.front = (q.front+1)%MAXSIZE;
		n++;
		PrintQueue(q);
	}
}

int getSum(Queue q)
{
	int i;
	int sum = 0;
	for (i=0;i<MAXSIZE;i++)
		sum += q.elem[i];
	return sum;
}


int main()
{
	Queue q;
	q = InitQueue();
	PrintQueue(q);
	Fab(q);
}
*/