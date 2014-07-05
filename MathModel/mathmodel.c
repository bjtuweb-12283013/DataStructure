#include <stdio.h>
#include <math.h>
#define MAX_X 10

int x[MAX_X][MAX_X], y[MAX_X][MAX_X];
int detx[MAX_X][MAX_X];
int h, t; //h为停靠一层的时间  t为运行一层的时间
int a,b;  //a为大于0的个数  b为小于0的个数
int T;  //T为总时间

void ShowMatrix()
{
	int i,j;
	printf("Matrix X is \n");
	for (i=1;i<=4;i++)
		for (j=2;j<=5;j++)
		{
			if (x[i][j]>20)
				printf("20 ");
			else
				printf("%d ", x[i][j]);
			if (j==5)
				printf("\n");
		}
	/*
	printf("Matrix Y is \n");
	for (i=1;i<=4;i++)
		for (j=2;j<=5;j++)
		{
			printf("%d ", y[i][j]);
			if (j==5)
				printf("\n");
		}

	printf("Matrix DetX is \n");
	for (i=1;i<=4;i++)
		for (j=2;j<=5;j++)
		{
			printf("%d ", detx[i][j]);
			if (j==5)
				printf("\n");
		}
	*/
}

void Init()
{
	int i, j;
	for (i=0;i<MAX_X;i++)
		for (j=0;j<MAX_X;j++)
		{
			x[i][j] = 0;
			y[i][j] = 0;
			detx[i][j] = 0;
		}
	printf("input h & t:");
	scanf("%d%d", &h, &t);
}

void InputValue()
{
	printf("input x12, x23, x34, x45:\n");
	scanf("%d", &x[1][2]);
	scanf("%d", &x[2][3]);
	scanf("%d", &x[3][4]);
	scanf("%d", &x[4][5]);
}

void CalcDetx()
{
	detx[1][2] = x[1][2] - 20;
	detx[2][3] = x[2][3] - 20;
	detx[3][4] = x[3][4] - 20;
	detx[4][5] = x[4][5] - 20;
}

void GetNum()
{
	a = 0;
	b = 0;
	if (detx[1][2]<0)
		a++;
	else if (detx[1][2]>0)
		b++;
	if (detx[2][3]<0)
		a++;
	else if (detx[2][3]>0)
		b++;
	if (detx[3][4]<0)
		a++;
	else if (detx[3][4]>0)
		b++;
	if (detx[4][5]<0)
		a++;
	else if (detx[4][5]>0)
		b++;
}

//a==1&&b==1  下同
void aEqual1_bEqual1()
{
	int i = 1;
	int c, d, e, f;
	for (i=1;i<=4;i++)
	{
		if (detx[i][i+1]>0)
		{
			c = i;
			d = i + 1;
		}
		if (detx[i][i+1]<0)
		{
			e = i;
			f = i + 1;
		}
	}
	x[e][d] = detx[c][d];
	//ShowMatrix();
}

void aEqual1_bEqual2()
{
	int i = 1;
	int c1, d1, c2, d2, e, f;
	int flag = 0;
	for (i=1;i<=4;i++)
	{
		if (detx[i][i+1]<0)
		{
			e = i;
			f = i + 1;
		}
		if (detx[i][i+1]>0)
		{
			if (flag == 0)
			{
				c1 = i;
				d1 = i +1;
				flag++;
			}
			else if (flag == 1)
			{
				c2 = i;
				d2 = i + 1;
			}
		}
	}
	x[e][d1] = detx[c1][d1];
	x[e][d2] = detx[c2][d2];
}

void aEqual1_bEqual3()
{
	int i;
	int c1, d1, c2, d2, c3, d3, e, f;
	int flag = 0;
	for (i=1;i<=4;i++)
	{
		if (detx[i][i+1]<0)
		{
			e = i;
			f = i + 1;
		}
		if (detx[i][i+1]>0)
		{
			if (flag == 0)
			{
				c1 = i;
				d1 = i +1;
				flag++;
			}
			else if (flag == 1)
			{
				c2 = i;
				d2 = i + 1;
				flag++;
			}
			else if (flag == 2)
			{
				c3 = i;
				d3 = i + 1;
			}
		}
	}
	x[e][d1] = detx[c1][d1];
	x[e][d2] = detx[c2][d2];
	x[e][d3] = detx[c3][d3];
}

void aEqual2_bEqual1()
{
	int i;
	int c, d, e1, f1, e2, f2;
	int flag = 0;
	for (i=1;i<=4;i++)
	{
		if (detx[i][i+1]>0)
		{
			c = i;
			d = i + 1;
		}
		if (detx[i][i+1]<0)
		{
			if (flag == 0)
			{
				e1 = i;
				f1 = i +1;
				flag++;
			}
			else if (flag == 1)
			{
				e2 = i;
				f2 = i + 1;
			}
		}
	}
	x[e1][d] = fabs(detx[e1][f1]);
	x[e2][d] = fabs(detx[e2][f2]);
}

void aEqual3_bEqual1()
{
	int i;
	int c, d, e1, f1, e2, f2, e3, f3;
	int flag = 0;
	for (i=1;i<=4;i++)
	{
		if (detx[i][i+1]>0)
		{
			c = i;
			d = i + 1;
		}
		if (detx[i][i+1]<0)
		{
			if (flag == 0)
			{
				e1 = i;
				f1 = i +1;
				flag++;
			}
			else if (flag == 1)
			{
				e2 = i;
				f2 = i + 1;
				flag++;
			}
			else if (flag == 2)
			{
				e3 = i;
				f3 = i + 1;
			}
		}
	}
	x[e1][d] = -detx[e1][f1];
	x[e2][d] = -detx[e2][f2];
	x[e3][d] = -detx[e3][f3];
}

void aEqual2_bEqual2()
{
	int c1, d1, c2, d2, e1, f1, e2, f2;
	int i;
	int positive1, positive2, negative1 ,negative2;
	int flag_pos = 0, flag_neg = 0;
	for (i=1;i<=4;i++)
	{
		if (detx[i][i+1]>0)
		{
			if (flag_pos==0)
			{
				positive1 = i;
				flag_pos++;
			}
			else if (flag_pos==1)
			{
				positive2 = i;
			}
		}
		if (detx[i][i+1]<0)
		{
			if (flag_neg==0)
			{
				negative1 = i;
				flag_neg++;
			}
			else if (flag_neg==1)
			{
				negative2 = i;
			}
		}
	}

	if (detx[positive1][positive1+1]>=detx[positive2][positive2+1])
	{
		c1 = positive1;
		d1 = positive1 + 1;
		c2 = positive2;
		d2 = positive2 + 1;
	}
	else
	{
		c2 = positive1;
		d2 = positive1 + 1;
		c1 = positive2;
		d1 = positive2 + 1;
	}

	if (detx[negative1][negative1+1]>=detx[negative2][negative2+1])
	{
		e1 = negative1;
		f1 = negative1 + 1;
		e2 = negative2;
		f2 = negative2 + 1;
	}
	else
	{
		e2 = negative1;
		f2 = negative1 + 1;
		e1 = negative2;
		f1 = negative2 + 1;
	}

	if (detx[c1][d1]==-detx[e2][f2])
	{
		x[e2][d1] = fabs(detx[e2][f2]);
		x[e1][d2] = fabs(detx[e1][f1]);
	}
	else if (detx[c1][d1]!=-detx[e2][f2])
	{
		if (detx[c1][d1]>-detx[e2][f2])
		{
			x[e2][d1] = fabs(detx[e2][f2]);
			x[e1][d2] = fabs(detx[c2][d2]);
			x[e1][d1] = detx[c1][d1] - detx[e2][f2];
		}
		else if (detx[c1][d1]<-detx[e2][f2])
		{
			x[e2][d1] = fabs(detx[c1][d1]);
			x[e1][d2] = 20 - fabs(detx[e1][f1]);
			x[e2][d2] = fabs(detx[e2][f2]) - detx[c1][d1];
		}
	}

}

void Handle()
{
	printf("a==%d, b==%d\n", a, b);
	if (a==0 && b==0)
		;
	if (a==1 && b==1)
		aEqual1_bEqual1();
	if (a==1 && b==2)
		aEqual1_bEqual2();
	if (a==1 && b==3)
		aEqual1_bEqual3();
	if (a==2 && b==1)
		aEqual2_bEqual1();
	if (a==2 && b==2)
		aEqual2_bEqual2();
	if (a==3 && b==1)
		aEqual3_bEqual1();
}

int GetMaxJ(int i)
{
	int maxj = -1;
	int j;
	for (j=2;j<=5;j++)
		if (y[i][j]==1)
			maxj = j;
	return maxj;
}

void CalcT()
{
	int i, j;
	for (i=1;i<=4;i++)
		for (j=2;j<=5;j++)
			if (x[i][j]==0)
				y[i][j] = 0;
			else
				y[i][j] = 1;

	int t1, t2, t3, t4;
	t1 = (y[1][2] + y[1][3] + y[1][4] + y[1][5])*h + GetMaxJ(1) * t; 
	t2 = (y[2][2] + y[2][3] + y[2][4] + y[2][5])*h + GetMaxJ(2) * t;
	t3 = (y[3][2] + y[3][3] + y[3][4] + y[3][5])*h + GetMaxJ(3) * t;
	t4 = (y[4][2] + y[4][3] + y[4][4] + y[4][5])*h + GetMaxJ(4) * t;
//	T = max(t1, t2, t3, t4);
	printf("t1 == %d\n", t1);
	printf("t2 == %d\n", t2);
	printf("t3 == %d\n", t3);
	printf("t4 == %d\n", t4);

	printf("----------------------------------\n");
	ShowMatrix();
}


int main()
{
	Init();
	InputValue();
	CalcDetx();
	GetNum();
	Handle();
	CalcT();
	return 0;
}