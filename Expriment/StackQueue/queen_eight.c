#include <stdio.h>
#include <math.h>

int pos[9];
int count = 0;
int queens[9][9];

void Initqueens()
{
	int i, j;
	for (i=0;i<9;i++)
		for (j=0;j<9;j++)
			queens[i][j] = 0;
}

void PrintQueen()
{
	Initqueens();
	int i, j;
	for (i=1;i<=8;i++)
	{
		printf("(%d %d) ", i, pos[i]);
		queens[i][pos[i]] = 1;
	}
	printf("\n");

	for (i=1;i<=8;i++)
	{
		for (j=1;j<=8;j++)
		{
			if (queens[i][j]==1)
				printf("%2s", "Q");
			else
				printf("%2s", ".");
			if (j==8)
				printf("\n");
		}
	}
		
	printf("\n");
	printf("\n");
}

int Check(int i, int j)
{
	int k = 1;
	while (k<i)
	{
		if(pos[k]==j || abs(pos[k]-j)==abs(k-i))
			return 0;
		k++;
	}
	return 1;
}

int Queen(int i)
{
	if (i>8)
	{
		PrintQueen();
		count++;
		return 0;
	}

	int j;
	for (j=1;j<=8;j++)
	{
		if (Check(i,j))
		{
			pos[i] = j;
			Queen(i+1);
		}
	}
	return 0;
}

int main()
{
	Queen(1);
	printf("sum == %d\n\n", count);
	return 0;
}