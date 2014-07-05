#include <stdio.h>
#define MAXSIZE 100

typedef struct 
{
	int elem[MAXSIZE];
	int front;
	int rear;
}Queue;

Queue InitQueue()
{
	Queue q;
	q.front = 0;
	q.rear = 0;
	return q;
}

int QueueEmpty(Queue q)
{
	if (q.front == q.rear)
		return 1;
	else
		return 0;
}

int QueueFull(Queue q)
{
	if ((q.rear+1)%MAXSIZE==q.front)
		return 1;
	else 
		return 0;
}

Queue EnQueue(Queue q, int e)
{
	if (QueueFull(q))
	{
		printf("FULL\n");
		exit(1);
	}

	q.elem[q.rear] = e;
	q.rear = (q.rear+1) % MAXSIZE;
	return q;
}

Queue DeQueue(Queue q)
{
	if (QueueEmpty(q))
	{
		printf("EMPTY\n");
		exit(1);
	}
	q.front = (q.front+1) % MAXSIZE;
	return q;
}

void PrintQueue(Queue q)
{
	if (QueueEmpty(q))
	{
		printf("EMPTY PRINT\n");
	}
	else
	{
		int p;
		for (p=q.front;p!=q.rear;p=(p+1)%MAXSIZE)
			printf("%d ", q.elem[p]);
		//printf("%d\n", q.elem[q.rear]);
		printf("\n");
	}
}

int main()
{
	Queue q;
	q = InitQueue();
	PrintQueue(q);

	int i;
	for (i=1;i<=99;i++)
		q = EnQueue(q, i);
	PrintQueue(q);
	return 0;
}