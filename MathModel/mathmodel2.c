#include <stdio.h>

int a2, a3, a4, a5;//去每层的人数
int x[10][100];
int det[50];

//初始化矩阵
void Init()
{	
	int i, j;
	for (i=0;i<10;i++)
		for (j=0;j<100;j++)
			x[i][j] = 0;
	x[0][0] = -1;
	for (i=1;i<=4;i++)
		x[i][0] = i+1;
	int sum = 20;
	for (j=1;j<=50;j++)
	{
		x[0][j] = sum;
		sum += 20;
	}
	for (i=0;i<50;i++)
		det[i] = 0;
}

//输入前往每层人数
void InputValue()
{
	scanf("%d", &a2);
	scanf("%d", &a3);
	scanf("%d", &a4);
	scanf("%d", &a5);
}

//核心处理函数
void Handle()
{
	int count, j;
	count = a2 / 20;
	for (j=1;j<=count;j++)
		x[1][j] = 1;
	if (a2%20==0)
		x[1][j-1] = 2;
	else
		det[0] = x[0][j] - a2;

	count = a3 / 20;
	for (j=1;j<=count;j++)
		x[2][j] = 1;
	if (a3%20==0)
		x[2][j-1] = 2;
	else
		det[1] = x[0][j] - a3;

	count = a4 / 20;
	for (j=1;j<=count;j++)
		x[3][j] = 1;
	if (a4%20==0)
		x[3][j-1] = 2;
	else
		det[2] = x[0][j] - a4;

	count = a5 / 20;
	for (j=1;j<=count;j++)
		x[4][j] = 1;
	if (a5%20==0)
		x[4][j-1] = 2;
	else
		det[3] = x[0][j] - a5;
}

//打印二维矩阵
void ShowMatrix()
{
	int i, j;
	for (i=0;i<=4;i++)
		for (j=0;j<=6;j++)
		{
			printf("%3d ", x[i][j]);
			if (j==6)
				printf("\n");
		}
	printf("------------------------------------------------\n");
	printf(" ");
	int sum = 0;
	for (i=0;i<4;i++)
	{
		sum += det[i];
		printf("%4d ", det[i]);
	}
	printf("\nsum==%d", sum);
		
	printf("\n");
}

int main()
{
	Init();
	InputValue();
	Handle();
	ShowMatrix();
	return 0;
}