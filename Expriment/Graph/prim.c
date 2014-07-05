#include "stdio.h"    
#define MAXEDGE 20
#define MAXVEX 20
#define INFINITY 65535

typedef struct
{
int arc[MAXVEX][MAXVEX];
int numVertexes, numEdges;
}MGraph;

void CreateMGraph(MGraph *G)
{
	int i, j;
	G->numEdges=15;
	G->numVertexes=9;
	for (i = 0; i < G->numVertexes; i++)
	{
		for ( j = 0; j < G->numVertexes; j++)
		{
			if (i==j)
				G->arc[i][j]=0;
			else
				G->arc[i][j] = G->arc[j][i] = INFINITY;
		}
	}
	G->arc[0][1]=10;
	G->arc[0][5]=11; 
	G->arc[1][2]=18; 
	G->arc[1][8]=12; 
	G->arc[1][6]=16; 
	G->arc[2][8]=8; 
	G->arc[2][3]=22; 
	G->arc[3][8]=21; 
	G->arc[3][6]=24; 
	G->arc[3][7]=16;
	G->arc[3][4]=20;
	G->arc[4][7]=7;   
	G->arc[4][5]=26; 
	G->arc[5][6]=17; 
	G->arc[6][7]=19; 
	for(i = 0; i < G->numVertexes; i++)
	{
		for(j = i; j < G->numVertexes; j++)
		{
			G->arc[j][i] =G->arc[i][j];
		}
	}
}

void MiniSpanTree_Prim(MGraph G)
{
	int min, i, j, k;
	int adjvex[MAXVEX];   
	int lowcost[MAXVEX]; 
	lowcost[0] = 0;
	adjvex[0] = 0; 
	for(i = 1; i < G.numVertexes; i++) 
	{
		lowcost[i] = G.arc[0][i];  
		adjvex[i] = 0;          
	}
	for(i = 1; i < G.numVertexes; i++)
	{
		min = INFINITY;
		j = 1;k = 0;
		while(j < G.numVertexes) 
		{
			if(lowcost[j]!=0 && lowcost[j] < min)
			{
			min = lowcost[j]; 
			k = j;  
			}
			j++;
		}
		printf("(%d, %d)\n", adjvex[k], k);
		lowcost[k] = 0;
		for(j = 1; j < G.numVertexes; j++) 
		{
			if(lowcost[j]!=0 && G.arc[k][j] < lowcost[j]) 
			{
				lowcost[j] = G.arc[k][j];
				adjvex[j] = k; 
			}
		}
	}
}

int main(void)
{
	MGraph G;
	CreateMGraph(&G);
	MiniSpanTree_Prim(G);
	return 0;
}